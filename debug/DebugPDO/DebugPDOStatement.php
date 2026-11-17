<?php

declare(strict_types=1);

require_once __DIR__ . "/SqlErrorContext.php";

/**
 * PDOStatement que intercepta a execução de prepared statements.
 */
class DebugPDOStatement extends PDOStatement
{
    /**
     * Parâmetros adicionados por bindValue() ou bindParam().
     *
     * @var array<int|string, array<string, mixed>>
     */
    private array $boundParameters = [];

    /**
     * O PDO cria essa classe internamente.
     *
     * Por isso, o construtor precisa ser protected.
     */
    protected function __construct() {}

    /**
     * Intercepta valores adicionados com bindValue().
     */
    public function bindValue(
        string|int $param,
        mixed $value,
        int $type = PDO::PARAM_STR
    ): bool {
        $this->boundParameters[$param] = [
            'value' => $value,
            'type' => $type,
            'binding' => 'bindValue',
        ];

        return parent::bindValue($param, $value, $type);
    }

    /**
     * Intercepta variáveis adicionadas com bindParam().
     */
    public function bindParam(
        string|int $param,
        mixed &$var,
        int $type = PDO::PARAM_STR,
        int $maxLength = 0,
        mixed $driverOptions = null
    ): bool {
        /*
         * O valor é armazenado por referência.
         *
         * Se a variável for alterada antes do execute(),
         * o valor atualizado será registrado.
         */
        $this->boundParameters[$param] = [
            'value' => &$var,
            'type' => $type,
            'binding' => 'bindParam',
        ];

        return parent::bindParam(
            $param,
            $var,
            $type,
            $maxLength,
            $driverOptions
        );
    }

    /**
     * Executa a consulta e registra os dados caso ocorra uma PDOException.
     *
     * @param array<int|string, mixed>|null $params
     */
    public function execute(?array $params = null): bool
    {
        try {
            return parent::execute($params);
        } catch (PDOException $exception) {
            SqlErrorContext::record(
                operation: 'PDOStatement::execute()',
                sql: $this->queryString,
                parameters: $this->resolveParameters($params),
                exception: $exception
            );

            /*
             * A exceção é relançada para que o Whoops possa exibi-la.
             */
            throw $exception;
        }
    }

    /**
     * Decide quais parâmetros foram utilizados na execução.
     *
     * @param array<int|string, mixed>|null $executeParameters
     *
     * @return array<int|string, mixed>
     */
    private function resolveParameters(
        ?array $executeParameters
    ): array {
        /*
         * Quando os valores são enviados diretamente ao execute(),
         * eles têm prioridade.
         */
        if ($executeParameters !== null) {
            return $executeParameters;
        }

        $parameters = [];

        foreach ($this->boundParameters as $name => $data) {
            $parameters[$name] = $data['value'];
        }

        return $parameters;
    }
}

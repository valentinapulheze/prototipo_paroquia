<?php

declare(strict_types=1);

// use PDO;
// use PDOException;
// use PDOStatement;

require_once __DIR__ . "/DebugPDOStatement.php";

/**
 * PDO que intercepta operações SQL com erro.
 *
 * Compatível com PHP 8.1 ou superior.
 */
class DebugPDO extends PDO
{
    public function __construct(
        string $dsn,
        ?string $username = null,
        ?string $password = null,
        ?array $options = null
    ) {
        $options ??= [];

        /*
         * O PDO precisa lançar exceções para que possamos
         * capturar e registrar os erros.
         */
        $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        parent::__construct(
            $dsn,
            $username,
            $password,
            $options
        );

        /*
         * Faz com que prepare() retorne DebugPDOStatement
         * no lugar de PDOStatement.
         */
        $this->setAttribute(
            PDO::ATTR_STATEMENT_CLASS,
            [DebugPDOStatement::class]
        );
    }

    /**
     * Intercepta erros ocorridos durante o prepare().
     */
    public function prepare(
        string $query,
        array $options = []
    ): PDOStatement|false {
        try {
            return parent::prepare($query, $options);
        } catch (PDOException $exception) {
            SqlErrorContext::record(
                operation: 'PDO::prepare()',
                sql: $query,
                parameters: [],
                exception: $exception
            );

            throw $exception;
        }
    }

    /**
     * Intercepta consultas executadas diretamente com query().
     */
    public function query(
        string $query,
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false {
        try {
            if ($fetchMode === null) {
                return parent::query($query);
            }

            return parent::query(
                $query,
                $fetchMode,
                ...$fetchModeArgs
            );
        } catch (PDOException $exception) {
            SqlErrorContext::record(
                operation: 'PDO::query()',
                sql: $query,
                parameters: [],
                exception: $exception
            );

            throw $exception;
        }
    }

    /**
     * Intercepta comandos executados diretamente com exec().
     */
    public function exec(string $statement): int|false
    {
        try {
            return parent::exec($statement);
        } catch (PDOException $exception) {
            SqlErrorContext::record(
                operation: 'PDO::exec()',
                sql: $statement,
                parameters: [],
                exception: $exception
            );

            throw $exception;
        }
    }
}

<?php

declare(strict_types=1);

/**
 * Armazena as informações da última operação SQL que gerou erro.
 */
class SqlErrorContext
{
    /**
     * Informações da última consulta que falhou.
     *
     * @var array<string, mixed>|null
     */
    private static ?array $lastError = null;

    /**
     * Registra uma operação SQL que gerou erro.
     *
     * @param array<int|string, mixed> $parameters
     */
    public static function record(
        string $operation,
        string $sql,
        array $parameters,
        PDOException $exception
    ): void {
        self::$lastError = [
            'Operação PDO' => $operation,
            'SQL preparada' => $sql,
            'Parâmetros' => $parameters,
            'SQL para visualização' => self::interpolate($sql, $parameters),
            'Mensagem do banco' => $exception->getMessage(),
            'Código do erro' => (string) $exception->getCode(),
            'Driver errorInfo' => $exception->errorInfo ?? [],
        ];
    }

    /**
     * Retorna os dados que serão apresentados no Whoops.
     *
     * @return array<string, mixed>
     */
    public static function getLastError(): array
    {
        return self::$lastError ?? [
            'Informação' => 'Nenhuma operação SQL foi registrada.',
        ];
    }

    /**
     * Remove as informações registradas.
     */
    public static function clear(): void
    {
        self::$lastError = null;
    }

    /**
     * Reconstrói uma SQL somente para facilitar a visualização.
     *
     * Essa SQL não deve ser executada.
     *
     * @param array<int|string, mixed> $parameters
     */
    private static function interpolate(
        string $sql,
        array $parameters
    ): string {
        if ($parameters === []) {
            return $sql;
        }

        /*
         * Placeholders posicionais:
         *
         * SELECT * FROM alunos WHERE id = ?
         */
        if (array_is_list($parameters)) {
            foreach ($parameters as $value) {
                $replacement = self::formatValue($value);

                $position = strpos($sql, '?');

                if ($position === false) {
                    break;
                }

                $sql = substr_replace(
                    $sql,
                    $replacement,
                    $position,
                    1
                );
            }

            return $sql;
        }

        /*
         * Placeholders nomeados:
         *
         * SELECT * FROM alunos WHERE id = :id
         */
        uksort(
            $parameters,
            static fn (
                int|string $first,
                int|string $second
            ): int => strlen((string) $second) <=> strlen((string) $first)
        );

        foreach ($parameters as $name => $value) {
            $placeholder = str_starts_with((string) $name, ':')
                ? (string) $name
                : ':' . $name;

            $sql = str_replace(
                $placeholder,
                self::formatValue($value),
                $sql
            );
        }

        return $sql;
    }

    /**
     * Formata um valor apenas para exibição.
     */
    private static function formatValue(mixed $value): string
    {
        return match (true) {
            $value === null => 'NULL',
            is_bool($value) => $value ? 'TRUE' : 'FALSE',
            is_int($value), is_float($value) => (string) $value,
            default => "'" . str_replace(
                "'",
                "''",
                (string) $value
            ) . "'",
        };
    }
}
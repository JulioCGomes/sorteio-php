<?php

class Jogos {

    /**
     * Método private de quantidade de dezenas.
     *
     * @var [type]
     */
    private $qtdDezenas;

    /**
     * Método private de resultado.
     *
     * @var [type]
     */
    private $resultado;

    /**
     * Resultado da aposta.
     *
     * @var [type]
     */
    private $resultadoAposta;

    /**
     * Método private de total de jogos.
     *
     * @var [type]
     */
    private $totalJogos;

    /**
     * Método private de jogos.
     *
     * @var [type]
     */
    private $jogos;

    /**
     * @Constante para validar a dezena.
     */
    const QTD_DEZENAS = [6, 7, 8, 9, 10];

    /**
     * Método construtor.
     *
     * @param integer $qtdDezenas
     * @param integer $totalJogos
     */
    public function __construct(int $qtdDezenas, int $totalJogos)
    {
        /**
         * Validando se foi enviado a qtd dezena certa.
         */
        $this->validarNumeroDezena($qtdDezenas);

        /**
         * Atribuindo q qtd dezenas sorteadas.
         */
        $this->qtdDezenas = $qtdDezenas;

        /**
         * Atribuindo qtd Jogos que será gerado.
         */
        $this->totalJogos = $totalJogos;
    }

    /**
     * Setando valor para os métodos.
     *
     * @param [type] $name
     * @param [type] $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * Recuperando os dados do método.
     *
     * @param [type] $name
     * @return void
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Validando se a qtd de dezena informada está dentro do range.
     *
     * @param int $numberDezena
     * @return void
     */
    private function validarNumeroDezena(int $numberDezena)
    {
        if (!in_array($numberDezena, self::QTD_DEZENAS)) {
            echo "Quantidade de dezenas inválido, informe entre 6 a 10";
            die();
        }
    }

    /**
     * Retornando o resultado com 6 dezenas.
     *
     * @return void
     */
    public function getResultadoAposta() : void 
    {
        $this->resultadoAposta = $this->sorteioDezenas();
    }

    /**
     * Retornando a quantidade de jogos.
     *
     * @return void
     */
    public function qtdTotalJogos() : void
    {
        $this->resultado = $this->getDezenas();
    }

    /**
     * Gerando as dezenas.
     *
     * @return Array
     */
    private function getDezenas() : array
    {
        return $this->sorteioDezenas();
    }

    /**
     * Sorteando o número
     *
     * @return array
     */
    private function sorteioDezenas() : array
    {
        for ($i = 1; $i <= $this->totalJogos; $i++) {
            $nDezenas = [];

            /**
             * Selecionando os números, total de "$this->qtdDezenas", sem repetir.
             */
            for ($g = 1; $g <= $this->qtdDezenas; $g++) {
                while (count($nDezenas) < $this->qtdDezenas) {
                    /**
                     * Gerando um número acrescentando o 0 a esquerda.
                     */
                    $dezenaGerada = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);

                    /**
                     * Verificando se não consta no array a dezena gerada.
                     */
                    if (!in_array($dezenaGerada, $nDezenas)) {
                        $nDezenas[] = $dezenaGerada;
                    }
                }
            }

            /**
             * Ordenando os números de forma crescente.
             */
            sort($nDezenas, SORT_NUMERIC);

            /**
             * Montando um array multidimensional para exibir a loteria dos números.
             */
            $loteria[]['dezenas'] = $nDezenas;
        }

        /**
         * Retornando os valores no array
         */
        return $loteria;
    }
}

/**
 * Instanciando a classe para geração do resultado da aposta.
 */
$resultadoSorteio = new Jogos(6, 5);

/**
 * Gerando o resultado da aposta.
 */
$resultadoSorteio->getResultadoAposta();
$arrSorteioResultado = current($resultadoSorteio->resultadoAposta)['dezenas'];

/**
 * Gerando o resultado do apostador.
 */
$resultadoSorteio->qtdTotalJogos();
$arrSorteioApostador = $resultadoSorteio->resultado;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Jogos</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Resultado</h1>
        <table>
            <tr>
                <?php for ($i=0; $i < count($arrSorteioResultado); $i++) : ?>
                    <th>#</th>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php foreach ($arrSorteioResultado as $sorteio) : ?>
                    <td><?php echo $sorteio ?></td>
                <?php endforeach; ?>
            </tr>
        </table>

        <hr>

        <h1>Resultado Apostador</h1>
        <table>
            <tr>
                <?php for ($i=0; $i < count(current($resultadoSorteio->resultado)['dezenas']); $i++) : ?>
                    <th>#</th>
                <?php endfor; ?>
            </tr>
            <?php foreach ($arrSorteioApostador as $sorteio) : ?>
                <tr>
                    <?php foreach ($sorteio['dezenas'] as $sorteio2) : ?>
                        <td><?php echo $sorteio2 ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>



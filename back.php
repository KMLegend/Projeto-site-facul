<?php
    $bdServidor = 'localhost';
    $bdUsuario = 'root';
    $bdSenha = 'UEG.Trindade:MySql';
    $bdBanco = 'tarefas';
    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

    if (mysqli_connect_errno()) {
        echo "Problemas para conectar no banco. Verifique os dados!";
        die();
    }

    function buscar_tarefas($conexao){
        $sqlBusca = 'SELECT * FROM tarefas';
        $resultado = mysqli_query($conexao, $sqlBusca);
        $tarefas = array();
        while ($tarefa = mysqli_fetch_assoc($resultado)) {
            $tarefas[] = $tarefa;
        }
        return $tarefas;
    }
    function gravar_tarefa($conexao, $tarefa){
       $data = $tarefa['prazo'] == '' ? '0000-00-00' : $tarefa['prazo'];
       $sqlGravar = "
        INSERT INTO tarefas
            (nome, descricao, prioridade, prazo, concluida)
            VALUES
            (
            '{$tarefa['nome']}',
            '{$tarefa['descricao']}',
            {$tarefa['prioridade']},
            '{$data}',
            {$tarefa['concluida']}
            )";
            //echo $sqlGravar;
    mysqli_query($conexao, $sqlGravar);
    }
    
    function buscar_tarefa($conexao, $id) {
        $sqlBusca = 'SELECT * FROM tarefas WHERE id = ' . $id;
        $resultado = mysqli_query($conexao, $sqlBusca);
        return mysqli_fetch_assoc($resultado);
    }
    function editar_tarefa($conexao, $tarefa)
    {
        $data = $tarefa['prazo'] == '' ? '0000-00-00' : $tarefa['prazo'];
    	$sql = "
        UPDATE tarefas SET
            nome = '{$tarefa['nome']}',
            descricao = '{$tarefa['descricao']}',
            prioridade = {$tarefa['prioridade']},
            prazo = '{$data}',
            concluida = {$tarefa['concluida']}
            WHERE id = {$tarefa['id']}";
        mysqli_query($conexao, $sql);
    }
    function remover_tarefa($conexao, $id)
    {
	    $sqlRemover = "DELETE FROM tarefas WHERE id = {$id}";
	    mysqli_query($conexao, $sqlRemover);
    }

    $exibir_tabela = true;
    $lista_tarefas = array();
    if (isset($_GET['nome']) && $_GET['nome'] != '') {
        $tarefa = array();
        $tarefa['nome'] = $_GET['nome'];
        if (isset($_GET['descricao'])) {
            $tarefa['descricao'] = $_GET['descricao'];
        } else {
            $tarefa['descricao'] = '';
        }
        if (isset($_GET['prazo'])) {
            $tarefa['prazo'] = traduz_data_para_banco($_GET['prazo']);
        } else {
            $tarefa['prazo'] = '';
        }
        
        $tarefa['prioridade'] = $_GET['prioridade'];
        
        if (isset($_GET['concluida'])) {
            $tarefa['concluida'] = 1;
        } else {
            $tarefa['concluida'] = 0;
        }
        gravar_tarefa($conexao, $tarefa);
    }
    $lista_tarefas = buscar_tarefas($conexao);         
    $tarefa = array(
        'id' => 0,
        'nome' => '',
        'descricao' => '',
        'prazo' => '',
        'prioridade' => 1,
        'concluida' => ''
    );



    function traduz_prioridade($codigo)
{
    $prioridade = '';
    switch ($codigo) {
        case 1:
            $prioridade = 'Alta';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Baixa';
            break;
    }
    return $prioridade;
}
function traduz_data_para_banco($data){
    if ($data == "") {
        return "";
    }
    $dados = explode("/", $data);
    $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";
    return $data_mysql;
}
function traduz_data_para_exibir($data)
{
	if ($data == "" OR $data == "0000-00-00") {
		return "";
	}	
	$dados = explode("-", $data);
	$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
	return $data_exibir;
}
function traduz_concluida($concluida)
{
	if ($concluida == 1) {
		return 'Sim';
	}
	return 'Não';
}

$exibir_tabela = false;
if (isset($_GET['nome']) && $_GET['nome'] != '') {
    $tarefa = array();
    $tarefa['id'] = $_GET['id'];
    $tarefa['nome'] = $_GET['nome'];
    if (isset($_GET['descricao'])) {
        $tarefa['descricao'] = $_GET['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }
    if (isset($_GET['prazo'])) {
        $tarefa['prazo'] = traduz_data_para_banco($_GET['prazo']);
    } else {
        $tarefa['prazo'] = '';
    }
    $tarefa['prioridade'] = $_GET['prioridade'];
    if (isset($_GET['concluida'])) {
        $tarefa['concluida'] = 1;
    } else {
        $tarefa['concluida'] = 0;
    }
    editar_tarefa($conexao, $tarefa);
    header('Location: tarefas.php');
    die();
}
$tarefa = buscar_tarefa($conexao, $_GET['id']);
?>
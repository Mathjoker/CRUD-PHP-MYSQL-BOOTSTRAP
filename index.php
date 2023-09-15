<?php
    require_once('conexao.php');

    if(isset($_GET['excluir'])){
        $id = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);

        if($id){
            $conexao->exec('DELETE FROM metas WHERE id=' . $id); 

            header('Location: index.php');
            exit;
        }
    }

    $results = $conexao->query('SELECT * FROM metas')->fetchAll();

    $arraySituacao = [1 => 'Aberta', 2 => 'Em Andamento', 3 => 'Realizado'];

    include_once('layout/_header.php');

?>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Minhas Metas</h5>
        <a class="btn btn-success" href="cadastro.php">Adicionar</a>
    </div>
    <div class="card-body ">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($results as $item): ?>
                    <tr>
                        <td><?= $item['descricao']?></td>
                        <td><?= $arraySituacao[$item['situacao']]?></td>
                        <td>
                            <a href="cadastro.php?id=<?= $item['id']?>" class="btn btn-sm btn-primary">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="excluir(<?= $item['id'] ?>)">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function excluir(id){
        if(confirm("Deseja excluir essa meta?")){
            window.location.href = "index.php?excluir=" + id;
        }
    }
</script>


<?php include_once('layout/_footer.php');?>
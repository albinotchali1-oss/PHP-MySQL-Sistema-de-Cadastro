<?php
require_once 'config.php';
$pesquisa = isset($_GET['pesquisa']) && is_string($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

if ($pesquisa !== '') {
    $termo = '%' . $pesquisa . '%';
    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE nome LIKE ? OR email LIKE ? OR id LIKE ?');
    $stmt->bind_param('sss', $termo, $termo, $termo);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $sql = 'SELECT * FROM usuarios';
    $res = $conn->query($sql);
}

if ($res->num_rows > 0) { 
?>
    <div class="container-list">
        <h2>usuários</h2>
        <div class="list-head">
            <div>ID</div>
            <div>Nome</div>
            <div>Email</div>
            <div>Telefone</div>
            <div>Data de Nascimento</div>
            <div>Cidade</div>
            <div>Sexo</div>
            <div>Ações</div>
        </div>
        <div class="list-body">
            <?php while ($row = $res->fetch_object()) { ?>
       
                    <div class="list-dados">
                        <div><?php print $row->id;?></div>
                        <div><?php print $row->nome;?></div>
                        <div><?php print $row->email;?></div>
                        <div><?php print $row->telefone;?></div>
                        <div><?php print $row->data_nasc;?></div>
                        <div><?php print $row->cidade;?></div>
                        <div><?php print $row->sexo;?></div>
                        <div class="btn-content">
                            <?php 
                            print "<button class='btn btn-edit' onclick=\"location.href='editar.php?id=".$row->id."';\"> Editar </button>";
    
                            print "<button class='btn btn-del' onclick=\"if(confirm('Deseja excluir usuário?')){location.href='excluir.php?id=".$row->id."';}else{false;}\">Excluir</button>";
                            ?>
                        </div>
                    </div>
           <?php } ?>
        </div>

<?php
}else{
  print " <p>Nenhum usuario cadastrado</p>";
}

?>
</div>
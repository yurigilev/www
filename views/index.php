<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery-2.0.3.min.js"></script>
    <script src="/js/scripts.js"></script>
    <title>Simple task manager</title>
</head>
<body>
    <div class="container">
        <h1>Менеджер заданий</h1>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand и toggle сгруппированы для лучшего отображения на мобильных дисплеях -->  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Соберите навигационные ссылки, формы, и другой контент для переключения -->  
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <? if (!isset($loginName)) {?>
      <form class="navbar-form navbar-left" action="/login/" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Login" name="login">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password" name="pass">
        </div>
        <button type="submit" class="btn btn-primary">Войдите</button>
      </form>      
        <?} else {?>
           <div class="logout"> Вы вошли как <?=$loginName?> <a href="/logout" class="btn btn-primary">Выйти</a></div>
        <?}?>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Сортировка <span class="caret"></span></a>
          <ul class="dropdown-menu">
                    <li><a href="/<?=$page?>/ID_ASC"><span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span> #ID</a></li>
                    <li><a href="/<?=$page?>/ID_DESC"><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span> #ID</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/<?=$page?>/NAME_ASC"><span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span> имя</a></li>
                    <li><a href="/<?=$page?>/NAME_DESC"><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span> имя</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/<?=$page?>/EMAIL_ASC"><span class="glyphicon glyphicon-sort-by-attributes" aria-hidden="true"></span> email</a></li>
                    <li><a href="/<?=$page?>/EMAIL_DESC"><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"></span> email</a></li>
                  </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->  
  </div><!-- /.container-fluid -->  
</nav>


      <? foreach ($tasks as $task) { ?>
            <div class="panel panel-<?if($task['status']=='done') {echo 'success';} else {echo 'primary';} ?>">
            <div class="panel-heading"><strong>#<?=$task['id']?></strong> <?=$task['name']?>, <?=$task['email']?>
               
            </div>
            <div class="panel-body" id="text<?=$task['id']?>">
                <?=$task['text']?>
            </div>
      <?if (isset($loginName)) {?><div class="panel-footer">
          <a href="/del/<?=$task['id']?>" class="btn btn-default"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> 
          <button onClick="javascript:moveData(<?=$task['id']?>);" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg1"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
          <input type="hidden" id="status<?=$task['id']?>" value="<?=$task['status']?>">
      </div><?}?>
          </div>
        <? }?>

<!-- Большая модаль --> 
<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myLargeModalLabel">Редактирование задачи</h4>
          </div>
          <div class="modal-body">
              <form action="/edit/" method="POST">
              <p><textarea class="form-control" rows="3" name="task" id="editText"></textarea></p>
              <p><input type="checkbox" name="status" id="editBox"> статус</p>
              <input type="hidden" name="id" id="editID">
              <button type="submit" class="btn btn-primary">Сохранить</button>
             </form>
        </div>
        </div>
  </div>
</div>


<!-- Большая модаль -->  
<button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Добавить задачу</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myLargeModalLabel">Новая задача</h4>
          </div>
          <div class="modal-body">
              <form action="/add/" method="POST">
              <p><input type="text" name="name" class="form-control" placeholder="ваше имя"></p>
              <p><input type="email" name="email" class="form-control" placeholder="email"></p>
              <p><textarea class="form-control" rows="3" name="task"></textarea></p>
              <button type="submit" class="btn btn-primary">Добавить</button>
             </form>
        </div>
        </div>
  </div>
</div>
        


      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li <?=$leftClass?>>
            <a href="/<?=$leftLink?>/" aria-label="Previous">
              <span aria-hidden="true">«</span>
            </a>
          </li>
          <?for ($i=1; $i<=$pages;$i++) {?>
            <li  <?if ($i==$page) {?>class="active"<?}?>><a href="/<?=$i?>/"><?=$i?></a></li>
          <?}?>
          <li <?=$rightClass?>>
            <a href="/<?=$rightLink?>/" aria-label="Next">
              <span aria-hidden="true">»</span>
            </a>
          </li>
        </ul>
      </nav>   
    </div>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
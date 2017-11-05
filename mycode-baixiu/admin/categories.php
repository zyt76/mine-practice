<?php
  require_once '../function.php';
  baixiu_get_current_user();

  // require_once '../function.php';
  baixiu_get_current_user();

  function add_category () {
    if (empty($_POST['name']) || empty($_POST['slug'])) {
      $GLOBALS['success'] = false;
      $GLOBALS['message'] = '请完整填写表单';
      return;
    }
    // 接收并保存
    $name = $_POST['name'];
    $slug = $_POST['slug'];

    $rows = xiu_execute("insert into categories values (null, '{$slug}', '{$name}');");
    $GLOBALS['message'] = ($rows <= 0) ? '添加失败' : '添加成功';
    $GLOBALS['success'] = $rows > 0;
  }


  // 如果修改操作与查询操作在一起, 一定是先做修改, 再查询
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 一旦表单提交请求, 就意味着是要添加数据
    add_category();
  }
  // 查询全部的分类数据
  $categories = xiu_fetch_all('select * from categories;');
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php'; ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <?php if (isset($message)) : ?>
      <div class="alert alert-<?php echo $success ? 'success' : 'danger' ?>">
        <strong><?php echo $success ? 'success' : 'danger' ?></strong><?php echo $message; ?>
      </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-4">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $item): ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['slug']; ?></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="category-delete.php?id=<?php echo $item['name']; ?>" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php $current_page = 'categories'; ?>
  <?php include 'inc/sidebar.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>
  // 1.不要重复使用无意义的选择操作, 应该采用变量去本地化
    ;$(function ($) {
      // 在表格中的任意一个 checkbox 选中状态变化时
      var $tbodyCheckboxs = $('tbody input');
      var $btnDelete = $("#btn_delete");
      $tbodyCheckboxs.on('change', function () {
        var flag = false;
        // 有任意一个 checkbox 选中就显示, 反之隐藏
        $tbodyCheckboxs.each(function (i, item) {
          if ($(item).prop('checked')) {
            flag = true;
          }
        })
      })
      flag ? $btnDelete.fadeIn() : $btnDelete.fadeOut();
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>

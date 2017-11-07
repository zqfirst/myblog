<?php

use \yii\web\View;

$this->title = $type == 'edit' ? "编辑文章" : "增加文章";
$this->registerJsFile( '/public/plugins/utf8-php/ueditor.config.js', [ 'position' => View::POS_HEAD ] );
$this->registerJsFile( '/public/plugins/utf8-php/ueditor.all.js', [ 'position' => View::POS_HEAD ] );
?>
<section class="content-header">
    <h1>
		<?= $this->title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $constUrlArray['backendIndex'] ?>"><i class="fa fa-user"></i>首页</a></li>
        <li class="active"><?= $this->title; ?></li>
</section>
<section class="content">
    <div class="box-body">
        <div class="row">
            <form class="form-horizontal" id="edit-article">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="category_id" class="control-label col-sm-1">所属分类</label>
                            <div class="col-sm-3">
                                <select id="category_id" class="form-control" name="category_id">
                                    <option value="0">---顶级---</option>
									<?php foreach ( $firstCategoryList as $category ): ?>
                                        <option value="<?= $category['id'] ?>"
											<?php
											if ( $model && $category['id'] == $model->category_id ) {
												echo 'selected';
											}
											?>
                                        >
											<?php
											if ( $category['parent_id'] != 0 ) {
												echo '-| &nbsp;';
											}
											?>
											<?= $category['name'] ?>
                                        </option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="Icon_Class" class="control-label col-sm-1">文章标题</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="title"
                                       value="<?= $model ? $model->title : '' ?>">
                            </div>
                            <label for="Icon_Class" class="control-label col-sm-1">关键字</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="keywords"
                                       value="<?= $model ? $model->keywords : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="Icon_Class" class="control-label col-sm-1">文章简介</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="decription"
                                       value="<?= $model ? $model->decription : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-1">文本内容</label>
                            <div class="col-sm-10">
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="content" type="text/plain">
                                    <?= $model ? $model->articleExtend->content : '' ?>

                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label class="control-label col-sm-1">是否展示</label>
                            <div class="col-sm-3">
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_show"
                                           value="1" <?php if ( ! $model || $model->is_show == 1 ) {
										echo 'checked';
									} ?>>展示
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_show"
                                           value="0" <?php if ( $model && $model->is_show == 0 ) {
										echo 'checked';
									} ?>>隐藏
                                </label>
                            </div>
                            <label class="control-label col-sm-1">是否推荐</label>
                            <div class="col-sm-3">
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_recommend"
                                           value="0" <?php if ( ! $model || $model->is_recommend == 0 ) {
				                        echo 'checked';
			                        } ?>>暂不推荐
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="radio" name="is_recommend"
                                           value="1" <?php if ( $model && $model->is_recommend == 1 ) {
				                        echo 'checked';
			                        } ?>>推荐
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-sm-offset-5">
                            <input type="hidden" name="<?= \Yii::$app->request->csrfParam ?>"
                                   value="<?= \Yii::$app->request->csrfToken ?>">
                            <button type="button" id="form-submit" class="btn btn-primary ">保存</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        var opt = {
            autoHeightEnabled: false,
            initialFrameHeight: 500,
        }
        var ue = UE.getEditor('container', opt);


        $('#form-submit').on('click', function () {
//            getAllHtml();
            var content = UE.getEditor('container').getContent();
            var data = $('#edit-article').serialize();
            $.post('', data, function (response) {
                if (response.code == <?=\ResponseCode::SUCCESS_CODE ?>) {
                    layer.closeAll('loading');
                    layer.msg(response.msg, {icon: 1});
                    location.href = response.url;
                } else {
                    layer.msg(response.msg, {icon: 2});
                }
            });
        })
    })
</script>
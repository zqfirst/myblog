<?php
$this->title = $type == 'edit' ? "编辑碎语" : "增加碎语";
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
			<form class="form-horizontal" id="edit-words">
				<div class="box-body">
					<input type="hidden" name="id" value="<?= \common\libs\http\RequestHelper::get('id')?>">
					<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
					       value="<?= Yii::$app->request->csrfToken ?>">
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="Icon_Class" class="control-label col-sm-3"><?=$model->getAttributeLabel('is_show')?></label>
							<div class="col-sm-6">
								<label class="checkbox-inline">
									<input type="radio" name="is_show" value="1" <?php if(!$model || $model->is_show == \common\models\life\BlogWords::SHOW) echo 'checked';?>>展示
								</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="checkbox-inline">
									<input type="radio" name="is_show" value="0" <?php if($model && $model->is_show == \common\models\life\BlogWords::NOT_SHOW) echo 'checked';?>>不展示
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="Icon_Class" class="control-label col-sm-3"><?=$model->getAttributeLabel('images')?></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="images" value="<?=$model->images?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="Icon_Class" class="control-label col-sm-3"><?=$model->getAttributeLabel('words')?></label>
							<div class="col-sm-6">
								<textarea name="words" id="" cols="65" rows="10" ><?=$model->words?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-sm-offset-2">
							<button type="button" id="form-submit" class="btn btn-primary">保存</button>
							<button type="reset" class="btn btn-default">重置</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
        $(function () {
            $('#form-submit').on('click', function () {
                var info = $('#edit-words').serialize();
                $.post({
                    'url' : "",
                    'type' : 'post',
                    'data':info,
                    'dataType':'json',
                    'success':function (response) {
                        if(response.code == <?=\ResponseCode::SUCCESS_CODE ?>)
                        {
                            layer.closeAll('loading');
                            layer.msg(response.msg, {icon: 1});
                            location.href=response.data.url;
                        } else {
                            layer.msg(response.msg, {icon: 2});
                        }

                    },
                    'error':function (error) {

                    }
                })
            })
        })
	</script>
</section>

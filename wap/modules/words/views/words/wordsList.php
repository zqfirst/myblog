<?php
$this->title = '闲言碎语';
$this->registerCssFile( '/static/css/say.css?v=1.1' );
?>
<div class="moodlist">
    <div class="bloglist">
		<?php
		if( isset( $wordsList ) && $wordsList ):
			foreach ( $wordsList as $list ):
				?>
                <ul class="arrow_box">
                    <div class="sy">
						<?php if( $list->images ): ?>
                            <img src="<?= $list->images ?>">
						<?php endif; ?>
                        <p><?= $list->words ?></p>
                    </div>
                    <span class="dateview"><?= substr( $list->create_time, 0, 10 ) ?></span>
                </ul>
				<?php
			endforeach;
		endif;
		?>
    </div>
    <div class="page">
	    <?=\yii\widgets\LinkPager::widget([
		    'pagination' => $pages,
	    ]);?>
    </div>
</div>
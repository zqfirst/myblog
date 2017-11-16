<?php
$this->title = '闲言碎语';
$this->registerCssFile( '/static/css/words/say.css' );
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
        <a title="Total record"><b>41</b></a><b>1</b>
        <a href="/static/images//index_2.html">2</a>
        <a href="/static/images/index_2.html">&gt;</a>
        <a href="/static/images//index_2.html">&gt;&gt;</a>
    </div>
</div>
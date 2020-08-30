<?php /* Available variables: $heading, $content, $type $class, $id, $style */ ?>
<div<?php if ( $id ): ?> id="<?php echo $id; ?>"<?php endif; ?> class="<?php echo $class; ?>"<?php if ( $style ): ?> style="<?php echo $style; ?>"<?php endif; ?>>
	<?php for ( $line = 0; $line < $count; ++ $line ): ?>
        <div>
            <div class="kntnt-collapse-content-heading"<?php if ( $heading_style ): ?> style="<?php echo $heading_style; ?>"<?php endif; ?>><?php echo $heading[ $line ]; ?></div>
            <div class="kntnt-collapse-content-body"<?php if ( $content_style ): ?> style="<?php echo $content_style; ?>"<?php endif; ?>><?php echo $content[ $line ]; ?></div>
        </div>
	<?php endfor; ?>
</div>
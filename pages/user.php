<?php
	if($action == 'edit' && $id) {
		
		if(isset($_POST['send'])) {
			
			echo message::success(lang::get('user_edited'));	
		}
		
	$sql = new sql();
	$sql->result("SELECT * FROM ".sql::table('user')." WHERE id = '".$sql->escape($id)."'");
?>

<form action="" method="post" id="userForm">
    <div class="tabs">
        <ul>
            <li><a href="#tab-1"><?=$sql->get('firstname').' '.$sql->get('name'); ?></a></li>
            <li><a href="#tab-2"><?=lang::get('rights'); ?></a></li>
        </ul>
        <div>
        
            <div id="tab-1">
                <h2><?=lang::get('profile'); ?></h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input">
                            <label><?=lang::get('firstname'); ?></label>
                            <input type="text" value="<?=$sql->get('firstname'); ?>">
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="input">
                            <label><?=lang::get('name'); ?></label>
                            <input type="text" value="<?=$sql->get('name'); ?>">
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="input">
                            <label><?=lang::get('email'); ?></label>
                            <input type="text" value="<?=$sql->get('email'); ?>">
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="input">
                            <label><?=lang::get('username'); ?></label>
                            <input type="text" value="<?=$sql->get('username'); ?>">
                        </div>
                    </div>
                </div>
                
                <h2><?=lang::get('password'); ?></h2>
                <p><?=lang::get('only_change'); ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input">
                            <label><?=lang::get('password'); ?></label>
                            <input type="text" value="<?=$sql->get('password'); ?>">
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div id="tab-2">
                <h2><?=lang::get('rights'); ?></h2>
                        
                <div id="rights">
                    
                    <ul>
                        <li data-action="create"><?=lang::get('create'); ?></li>
                        <li data-action="edit"><?=lang::get('edit'); ?></li>
                        <li data-action="delete"><?=lang::get('delete'); ?></li>
                    </ul>
                
                    <hr>
                
                    <div class="row">
                        
                        <div class="col-md-3 col-sm-6">
                            <h3><?=lang::get('server'); ?></h3>
                            <ul class="box" data-type="server">
                            </ul>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <h3><?=lang::get('games'); ?></h3>
                            <ul class="box" data-type="games">
                            </ul>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <h3><?=lang::get('user'); ?></h3>
                            <ul class="box" data-type="user">
                            </ul>
                        </div>
                        
                    </div>
                
                </div>
            </div>
                
            <hr>
            
            <a href="?page=user" class="light button"><?=lang::get('back'); ?></a>
            <button type="submit" name="send"><?=lang::get('apply'); ?></button>
        
        </div>
    </div>
</form>

<?php	
	} else {
		
	$table = new table();
		
	$table->addCollsLayout('25, 30%, *, 140, 100');
	
	$table->addRow()
		->addCell("
			<input type='checkbox' id='all'>
			<label for='all'></label>
		", ['class'=>'checkbox'])
		->addCell(lang::get('name'))
		->addCell(lang::get('email'))
		->addCell(lang::get('username'))
		->addCell("");
	
	$table->addSection('tbody');
	
	$table->setSql('SELECT * FROM '.sql::table('user'));
	
	while($table->isNext()) {
		
		$id = $table->get('id');
		
		$edit = '<a class="btn" href="?page=user&action=edit&id='.$id.'">'.layout::svg('edit').'</a>';
		
		$table->addRow()
			->addCell("
				<input type='checkbox' id='id".$id."'>
				<label for='id".$id."'></label>
			", ['class'=>'checkbox'])
			->addCell($table->get('firstname')." ".$table->get('name'))
			->addCell($table->get('email'))
			->addCell($table->get('username'))
			->addCell($edit);
		
		$table->next();
	
	}
?>

<div class="panel">
    <div class="top">
        <h3><?=$table->numSql().' '.lang::get('user'); ?> </h3>
        <ul>
            <li>
                <a href="">
                	<?=layout::svg('delete'); ?>
                </a>
            </li>
        </ul>
    </div>
    <?=$table->show(); ?>
</div>

<?php } ?>
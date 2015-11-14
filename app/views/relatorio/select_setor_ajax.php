
<div class="row">
	<div class="large-4 columns" align="right">
		Setor:
	</div>
	<div class="large-4 columns">
		<select name="intpoloid" required>
			<option>--selecione o setor--</option>
			<option value="99999">TODOS</option>
			<?php
				foreach($select_setor as $row){
			?>
					<option value="<?=$row->intsetorid?>"><?=$row->strsetor?></option>
			<?php
				}
			?>
		</select>
	</div>
	<div class="large-4 columns">

	</div>
</div>

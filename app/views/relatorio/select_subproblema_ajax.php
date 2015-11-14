
<div class="row">
	<div class="large-4 columns" align="right">
		Subproblema:
	</div>
	<div class="large-4 columns">
		<select name="intpoloid" required>
			<option>--selecione o subproblema--</option>
			<option value="99999">TODOS</option>
			<?php
				foreach($select_subproblema as $row){
			?>
					<option value="<?=$row->intsubproblemid?>"><?=$row->strsubproblem?></option>
			<?php
				}
			?>
		</select>
	</div>
	<div class="large-4 columns">

	</div>
</div>

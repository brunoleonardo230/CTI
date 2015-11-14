<div class="row">
	<div class="large-6 columns">
		<label><p class="titulo">Computador:</p>
			<select name="cpuid" required>
				<option value="" disabled>--- SELECIONE UM COMPUTADOR ---</option>
				<?php foreach($cpus as $cpu) { ?>
				<option value="<?= $cpu->idcpu ?>"><?= $cpu->strnomecpu ?></option>
				<?php } ?>
			</select>
		</label>
	</div>
</div>
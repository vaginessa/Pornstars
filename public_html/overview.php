<?php

require 'inc.bootstrap.php';

logincheck();

_header();

?>
<h2>.: Message from The Creator :.</h2>
<table>
	<tr>
		<td>
			<?= nl2br($g_prefs->general_adminmsg) ?>
		</td>
	</tr>
</table>
<br />


<? if ( $g_user->newbie_ticks > 0 ): ?>
	<h2>.: Messages / News :.</h2>
	<table>
		<tr>
			<td align="center">
				You are under newbie protection for <?= $g_user->newbie_ticks ?> more ticks
			</td>
		</tr>
	</table>
	<br />
<? endif ?>


<? if ( $g_user->galaxy->gc ): ?>
	<h2>.: Galactic Message :.</h2>
	<table>
		<tr>
			<td>
				Your GC (<?= $g_user->galaxy->gc ?>) says:<br />
				<?= nl2br(html($g_user->galaxy->gc_message)) ?>
			</td>
		</tr>
	</table>
	<br />
<? endif ?>


<h2>.: Research &amp; Development :.</h2>
<table>
	<tr>
		<td></td>
		<td>Name</td>
		<td>ETA</td>
		<td>Progress</td>
	</tr>
	<tr>
		<td><a href="research.php">Researching</a></td>
		<td><?= $g_user->researching ? html($g_user->researching->name) : '-' ?></td>
		<td><?= $g_user->researching ? $g_user->researching->eta : '-' ?></td>
		<td><?= $g_user->researching ? $g_user->researching->pct_done . ' %' : '-' ?></td>
	</tr>
	<tr>
		<td><a href="construction.php">Constructing</a></td>
		<td><?= $g_user->constructing ? html($g_user->constructing->name) : '-' ?></td>
		<td><?= $g_user->constructing ? $g_user->constructing->eta : '-' ?></td>
		<td><?= $g_user->constructing ? $g_user->constructing->pct_done . ' %' : '-' ?></td>
	</tr>
</table>
<br />


<h2>.: Skills :.</h2>
<table>
	<? foreach ( $g_user->skills as $skill ): ?>
		<tr>
			<td><?= $skill->skill ?></td>
			<td><?= nummertje($skill->planet_value) ?></td>
		</tr>
	<? endforeach ?>
</table>
<br />


<? if ( $g_user->ships ): ?>
	<h2>.: Mobile units (<?= nummertje($g_user->total_ships) ?>) :.</h2>
	<table>
		<? foreach ( $g_user->ships as $ship ): ?>
			<tr>
				<td><?= html($ship->unit) ?></td>
				<td><?= nummertje($ship->planet_amount) ?></td>
			</tr>
		<? endforeach ?>
	</table>
	<br />
<? endif ?>


<? if ( $g_user->defences ): ?>
	<h2>.: Static units (<?= nummertje($g_user->total_defences) ?>) :.</h2>
	<table>
		<? foreach ( $g_user->defences as $defence ): ?>
			<tr>
				<td><?= html($defence->unit) ?></td>
				<td><?= nummertje($defence->planet_amount) ?></td>
			</tr>
		<? endforeach ?>
	</table>
	<br />
<? endif ?>


<h2>.: Resources :.</h2>
<table>
	<? foreach ( $g_user->resources AS $resource ): ?>
		<tr>
			<td><?= html($resource->resource) ?></td>
			<td><?= nummertje($resource->display_number) ?> <?= $resource->display_name ?></td>
			<td>+ <?= nummertje($g_user->ticker->getIncome($resource)) ?></td>
		</tr>
	<? endforeach ?>
	<tr>
		<td>Inactive asteroids</td>
		<td><?= nummertje($g_user->inactive_asteroids) ?></td>
		<td></td>
	</tr>
</table>
<br />


<h2>.: Fleet Status :.</h2>
<table>
	<? foreach ( $g_user->fleets AS $fleet ): ?>
		<tr class="<?= html($fleet->action) ?>ing fleet">
			<td><?= html($fleet) ?></td>
			<td align="center"><?= nummertje($fleet->total_ships) ?> units</td>
			<td>
					<? if ( $fleet->action == 'return' ): ?>
						is returning from <?= $fleet->destination_planet ?> (ETA: <?= $fleet->travel_eta ?>)
					<? elseif ( in_array($fleet->action, ['attack', 'defend']) ): ?>
						<? if ( $fleet->activated ): ?>
							is <?= $fleet->action ?>ing <?= $fleet->destination_planet ?> for <?= $fleet->action_eta ?> more ticks
						<? else: ?>
							is moving to <?= $fleet->action ?> <?= $fleet->destination_planet ?> (ETA: <?= $fleet->travel_eta ?>)
						<? endif ?>
					<? elseif ( $fleet->fleetname ): ?>
						is idling at home...
					<? else: ?>
						is fixed at home
					<? endif ?>
			</td>
		</tr>
	<? endforeach ?>
</table>
<br />

<?php

_footer();

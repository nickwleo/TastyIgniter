<?php echo $header; ?>
<div class="row content">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				<h3 class="panel-title">Rating List</h3>
			</div>
			<form role="form" id="edit-form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo current_url(); ?>">
				<table class="table table-striped table-border table-sortable">
					<thead>
						<tr>
							<th class="action action-one"></th>
							<th class="action action-one"></th>
							<th>Name</th>
						</tr>
					</thead>
					<tbody>
						<?php $table_row = 1; ?>
						<?php foreach ($ratings as $key => $value) { ?>
							<tr id="table-row<?php echo $table_row; ?>">
								<td class="action action-one text-center"><i class="fa fa-sort handle"></i></td>
								<td class="action action-one"><a class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a></td>
								<td>
									<input type="text" name="ratings[<?php echo $table_row; ?>]" class="form-control" value="<?php echo set_value('ratings[$table_row]', $value); ?>" />
									<?php echo form_error('ratings['.$table_row.']', '<span class="text-danger">', '</span>'); ?>
								</td>
							</tr>
						<?php $table_row++; ?>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr id="tfoot">
							<td class="action action-one text-center"><a class="btn btn-primary btn-lg" onclick="addRating();"><i class="fa fa-plus"></i></a></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
var table_row = <?php echo $table_row; ?>;

function addRating() {
	html  = '<tr id="table-row' + table_row + '">';
    html += '	<td class="action action-one"><i class="fa fa-sort handle"></i></td>';
	html += '	<td class="action action-one"><a class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times-circle"></i></a></td>';
	html += '	<td><input type="text" name="ratings[' + table_row + ']" class="form-control" value="<?php echo set_value("ratings[' + table_row + ']"); ?>" /></td>';
	html += '</tr>';

	$('.table-sortable tbody').append(html);

	table_row++;
}
//--></script>
<script src="<?php echo root_url("assets/js/jquery-sortable.js"); ?>"></script>
<script type="text/javascript"><!--
$(function () {
	$('.table-sortable').sortable({
		containerSelector: 'table',
		itemPath: '> tbody',
		itemSelector: 'tr',
		placeholder: '<tr class="placeholder"><td colspan="3"></td></tr>',
		handle: '.handle'
	})
})
//--></script>
<?php echo $footer; ?>
<?php

if($_SESSION['type']=='superadmin'){
	echo '<button class="btn btn-info" id="exbtn" data-toggle="modal" data-target="#exmodal"><span class="glyphicon glyphicon-export"></span> Export Logging</button>
			<!--Export Modal-->
			<div id="export">
			<div id="exmodal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title"><span class="glyphicon glyphicon-export"></span>Export Admin Message</h4>
			      </div>
			      <div class="modal-body">
			      <form id="exportform" method="POST" action="asset/php/export.php?table=adminmsg">
			      	<div class="form-group">
							<label for="exname">Export file name:</label>
						 <input type="text" class="form-control" name="ename" id="ename" value="adminmsg"date("Y-m-d")";>
					 </div>
					 <div class="form-group">
					 	<label for="exformat">Export Format</label>
							<select class="form-control" id="exformat" name="format">
							    <option name="format" value="xls">xls</option>
							    <option name="format" value="csv">csv</option>
							    <!--<option name="format" value="sql">sql</option>-->
							 </select>
					 </div>
					 <div id="callmsg"></div>
			      </div>
			      <div class="modal-footer">
			      	<button type="submit" name="subex" class="btn btn-success">Export</button>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			      </form>
			    </div>

			  </div>
			</div>
			</div>
			<!--Export Modal End-->';
}
?>

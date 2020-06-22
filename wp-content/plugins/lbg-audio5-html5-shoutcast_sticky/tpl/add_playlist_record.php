<div class="wrap">
	<div id="lbg_logo">
			<h2>Playlist for player: <span style="color:#FF0000; font-weight:bold;"><?php echo $_SESSION['xname']?> - ID #<?php echo $_SESSION['xid']?></span> - Add New</h2>
 	</div>

    <form method="POST" enctype="multipart/form-data" id="form-add-playlist-record">
	    <input name="playerid" type="hidden" value="<?php echo $_SESSION['xid']?>" />
		<table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="left" valign="middle" width="25%">&nbsp;</td>
		    <td align="left" valign="middle" width="77%"><a href="?page=LBG_AUDIO5_HTML5_SHOUTCAST_Playlist" style="padding-left:25%;">Back to Playlist</a></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title">Set It First</td>
		    <td align="left" valign="top"><input name="setitfirst" type="checkbox" id="setitfirst" value="1" checked="checked" />
		      <label for="setitfirst"></label></td>
	      </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title">Stream*</td>
		    <td align="left" valign="top"><input name="xradiostream" type="text" size="80" id="xradiostream" value="<?php echo (array_key_exists('xradiostream', $_POST))?strip_tags($_POST['xradiostream']):''?>"/></td>
	      </tr>
		  <tr>
		    <td align="left" valign="middle">&nbsp;</td>
		    <td align="left" valign="top"><span class="small_text"><u>Shoutcast link structure:</u> http://[ip]:[port]/;<br />
		      <u>Icecast link structure:</u> http://[domain]:[port]/mountpoint</span></td>
		    </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title">Stream Title (optional)<br /><span class="small_text">it will be automatically obtained</span></td>
		    <td align="left" valign="top"><input name="xstation" type="text" size="80" id="xstation" value="<?php echo (array_key_exists('xstation', $_POST))?strip_tags($_POST['xstation']):''?>"/></td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Category (optional)<br />
<span class="small_text">it will be automatically obtained</span></td>
		    <td align="left" valign="top"><?php
				$my_categ=array();
				if (array_key_exists('category', $_POST)) {
						$my_categ=$_POST['category'];
				}
				foreach ( $result as $row )
				{
					$row=lbg_audio5_html5_shoutcast_unstrip_array($row); ?>
				<p><input name="category[]" id="category" type="checkbox" value="<?php echo $row['id'];?>" <?php echo ( in_array($row['id'],$my_categ) )?'checked="checked"':''?> /> <?php echo $row['categ'];?></p>
				<?php }	?></td>
	      </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title">Associated page link (optional)</td>
		    <td align="left" valign="top"><input name="xassociatedpageurl" type="text" size="80" id="xassociatedpageurl" value="<?php echo (array_key_exists('xassociatedpageurl', $_POST))?strip_tags($_POST['xassociatedpageurl']):''?>"/></td>
	      </tr>
		  <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle">*Required fields</td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit" id="Submit" type="submit" class="button-primary" value="Add Record"></td>
		  </tr>
		</table>
  </form>






</div>

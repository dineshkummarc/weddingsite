    <tr> 
      <td width="1"><img src="/images/transparent-gif.gif" width="1" height="1"></td>
      <td colspan="2" valign="top" bgcolor="#EBEBEB">
	  <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr> 
            <td colspan="4"><div class="subheader">CENTCOM :: Wedding Central Command</div><hr /></td>
          </tr>
          <tr> 
            <td colspan="2" valign="top"><p><b>Use the tools below to generate real-time reports
			about the wedding guests and other wedding resources (companies, dates, people, etc).</b></p><hr />
			<div align="center">
				<form name="toolremoteform">
					<table border="0" width="400">
						<tbody>
							<tr>
								<td colspan="2" align="center" width="100%">
									<input type="button" name="ltfo" value="Log Out of CENTCOM" style="WIDTH: 180px;" onclick="window.location.href='/centcom/logout'" />
								</td>
							</tr>
							<tr>
								<td align="center" width="50%">
									<input name="listgroom" value="View All Groom's Guests" onclick="Effect.Grow('groomlist'); return false;" style="width: 180px;" type="button" />
								</td>
								<td align="center" width="50%">
									<input name="listbride" value="View All Bride's Guests" onclick="Effect.Grow('bridelist'); return false;" style="width: 180px;" type="button" />
								</td>
							</tr>
							<tr>
								<td align="center" width="50%">
									<input name="managestaff" value="Manage Registries" onclick="Effect.Grow('registry'); return false;" style="width: 180px;" type="button" />
								</td>
								<td align="center" width="50%">
									<input name="manageteams" value="Manage Biographies" style="width: 180px;" title="" type="button">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!--Groom's list-->
			<div align="center" style="display:none; background:#ddd;" id="groomlist">
				<div align="right">
					Close this --&rsaquo;<a href="#" onclick="Effect.Shrink('groomlist'); return false;">[x]</a>
				</div>
				<?=$groomlist?>
			</div>
			<!--End Groom's list-->
			<!--Bride's list-->
			<div align="center" style="display:none; background:#ddd;" id="bridelist">
				<div align="right">
					Close this --&rsaquo;<a href="#" onclick="Effect.Shrink('bridelist'); return false;">[x]</a>
				</div>
				<?=$bridelist?>
			</div>
			<!--End Bride's list-->
			<!--Registry List-->
			<div align="center" style="display:none; background:#ddd;" id="registry">
				<div align="right">
					Close this --&rsaquo;<a href="#" onclick="Effect.Shrink('registry'); return false;">[x]</a>
				</div>
				<?=$registrylist?>
			</div>
			<!--End Registry list-->
			
			</td>
            <td width="2%" valign="bottom">&nbsp;</td>
          </tr>
		  <tr><td>&nbsp;</td></tr>
        </table>
		</td>
    </tr>
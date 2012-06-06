    <tr> 
      <td width="1"><img src="/images/transparent-gif.gif" width="1" height="1"></td>
      <td colspan="2" valign="top" bgcolor="#EBEBEB">
	  <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr> 
            <td colspan="4"><div class="subheader">Guestbook - Leave us a message!</div><hr /></td>

          </tr>
		<tr>
			<td>
			<?=$formspot?>
			</td>
		</tr>
        <tr> 
            <td colspan="2" valign="top" align="center">
				<?php echo $this->pagination->create_links(); ?>
				<br />
				<?php echo $this->table->generate($entries); ?>
			</td>
        </tr>
		<tr><td>&nbsp;</td></tr>
        </table>
		</td>
    </tr>
    
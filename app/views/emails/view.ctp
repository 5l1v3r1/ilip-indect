
<div class="generic boxstyle_white">
	<h2><?php __('Email to'); echo str_replace('>', '&gt;', str_replace('<', '&lt;', $mailObj['to']))?></h2>

	<div>
		<table>

			<tbody>
				<tr>
				<td><?php __('Subject:'); ?></td>
				<?php if (isset($mailObj['Subject'])): ?>
				<?php if (strpos($email['Email']['subject'], '=?') != 0): ?>
				<td class="subject"><?php echo htmlentities($mailObj['Subject']); ?></td>
				<?php else: ?>
				<td class="subject"><?php echo $mailObj['Subject']; ?></td>
				<?php endif; ?>
				<?php else: ?>
				<td class="subject"></td>
				<?php endif; ?>
				<td><?php __('Relevance:'); ?></td>
				<td class="date pinfo">
					<?php echo $form->create('Email',    array ('action' => 'view'));?>
				        <?php   echo $form->select('relevance', $relevanceoptions, $email['Email']['relevance'] ,array('label' => __('Choose relevance', true), 'empty' => __('None', true)));     ?>
				</td>
				</tr>
				<tr>
				<td><?php __('Sender:'); ?></td>
				<td class="from"><?php echo str_replace('>', '&gt;', str_replace('<', '&lt;', $mailObj['from']))?></td>
				<td rowspan="7"><?php __('Comments'); ?></td>
				<td class="date pinfo" rowspan="7">
				        <?php echo $form->input ('comments', array ('label' => false, 'rows' => '5', 'cols' => '47', 'maxlength'=>'3000')       );        ?>
					<?php echo $form->end(__('Save', true));?>
				</td>
				</tr>
				<tr>
				<td><?php __('Recipient:'); ?></td>
				<td class="to"><?php echo str_replace('>', '&gt;', str_replace('<', '&lt;', $mailObj['to']))?></td>
				</tr>
				<tr>
				<td><?php __('Date:'); ?></td>
				<td class="date"><?php echo $mailObj['Date']?></td>
				</tr>
				<tr>
				<td><?php __('Username:'); ?></td>
				<td class="date"><?php echo $email['Email']['username']?></td>
				</tr>
				<tr>
				<td><?php __('Password:'); ?></td>
				<td class="date"><?php echo $email['Email']['password']?></td>
				</tr>
				<tr>
				<td><?php __('EML file:'); ?></td>
				<td class="date"><?php echo $html->link('email.eml', '/emails/eml') ?></td>
				</tr>
				<tr>
				<td><?php __('Info:'); ?></td>
				<td class="date pinfo"><a href="#" onclick="popupVetrina('/emails/info','scrollbar=auto'); return false"><?php __('info.xml'); ?></a><div class="ipcap"><?php echo $html->link('pcap', 'pcap/'); ?></div></td>
				</tr>
			</tbody>
		</table>

		<div  id="messageframe">

			<div id="email_view">
				<!-- <?php __('Edit'); ?> -->
			    <?php echo $this->Form->create('Edit', array('url' => '/emails/view/'.$email['Email']['id']));
				    echo $this->Form->input('relevance', array('options' => $relevanceoptions, 'default' => $email['Email']['relevance'] ,'empty'=>'-- Choose relevance --'));
				    echo $this->Form->input('comments', array('type'=>'string', 'style' => 'width:400px','default' => $email['Email']['comments']));
				?>
			    <?php echo $this->Form->end(__('Save', true)); ?>
			</div>
			<div id="contents_view">
				<?php __('Contents'); ?>

				<?php if ($mailObj['Type'] == 'html') : ?>
				<object class="html" type="text/html" data="/emails/content/<?php echo strrchr($mailObj['DataFile'], '/')?>">
				<p>backup content</p>
				</object>
				<?php elseif ($mailObj['Type'] == 'text') : ?>
				<div class="centered">
					<textarea cols="81" rows="10" readonly="readonly" ><?php echo file_get_contents($mailObj['DataFile']); ?></textarea>
				</div>
				<?php endif; ?>
				<?php if (isset($mailObj['Attachments'])) : ?>
					<table class="headers-table" >
						<tbody>
						<?php $i = 1; foreach($mailObj['Attachments'] as $attachment) : ?>
							<tr>
						    	<td><?php __('Attached'); echo ' '.$attachment['Type'] ?></td>
						    	<?php if (isset($attachment['FileName'])) : ?>
						    	<?php if (strpos($attachment['FileName'], '=?') != 0): ?>
						    	<td class="date"><?php echo $html->link(htmlentities($attachment['FileName']), '/emails/content'.strrchr($attachment['DataFile'], '/')) ?></td>
						    	<?php else: ?>
						    	<td class="date"><?php echo $html->link($attachment['FileName'], '/emails/content'.strrchr($attachment['DataFile'], '/')) ?></td>
						    	<?php endif; ?>
						    	<?php elseif (isset($attachment['Description'])) : ?>
						    	<td class="date"><?php echo $html->link($attachment['Description'], '/emails/content'.strrchr($attachment['DataFile'], '/')) ?></td>
						    	<?php endif; ?>
						    </tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
<?php
/*
* view for add/edit/view fees ccomponents
* Author:Sachin Awari
* Created at: 02 Jan 2017
* Last updated: 02 Jan 2017
*/	

$Id = $this->uri->segment('3');
$getId = $Id!="" ? $Id : '0';

$fp_title  = $fp_desc = $fp_late_payment_id = $fp_fee_type_id = '';
$actionMsg = "";
$btnMsg = "Save";
$optradio1 = "checked";
$optradio2 = "";
//if(count($tc_all_data)>0){
	 // pre($tc_all_data,1);
$tc_first_admission_with_class=isset($tc_all_data->tc_first_admission_with_class)?$tc_all_data->tc_first_admission_with_class:'';
$tc_last_taken_result=isset($tc_all_data->tc_last_taken_result)?$tc_all_data->tc_last_taken_result:'';
$tc_whether_failed=isset($tc_all_data->tc_whether_failed)?$tc_all_data->tc_whether_failed:'';
$tc_subjects=isset($tc_all_data->tc_subjects)?$tc_all_data->tc_subjects:'';
$tc_is_promoted_to_class=isset($tc_all_data->tc_is_promoted_to_class)?$tc_all_data->tc_is_promoted_to_class:'';
$tc_promoted_class=isset($tc_all_data->tc_promoted_class)?$tc_all_data->tc_promoted_class:'';
$tc_fees_paid_month=isset($tc_all_data->tc_fees_paid_month)?$tc_all_data->tc_fees_paid_month:'';
$tc_fees_concession=isset($tc_all_data->tc_fees_concession)?$tc_all_data->tc_fees_concession:'';
$tc_working_days=isset($tc_all_data->tc_working_days)?$tc_all_data->tc_working_days:$attendance['total_day'];
$tc_working_days_present=isset($tc_all_data->tc_working_days_present)?$tc_all_data->tc_working_days_present:$attendance['present'];
$tc_ncc=isset($tc_all_data->tc_ncc)?$tc_all_data->tc_ncc:'';
$tc_extra_activity=isset($tc_all_data->tc_extra_activity)?$tc_all_data->tc_extra_activity:'';
$tc_general_conduct=isset($tc_all_data->tc_general_conduct)?$tc_all_data->tc_general_conduct:'';
$tc_date_of_app_cert=isset($tc_all_data->tc_date_of_app_cert)?date("d-m-Y",strtotime($tc_all_data->tc_date_of_app_cert)):'';
$tc_date_of_certificate=isset($tc_all_data->tc_date_of_certificate)?date("d-m-Y",strtotime($tc_all_data->tc_date_of_certificate)):'';
$tc_reason_for_leaving_school=isset($tc_all_data->tc_reason_for_leaving_school)?$tc_all_data->tc_reason_for_leaving_school:'';
$tc_remark=isset($tc_all_data->tc_remark)?$tc_all_data->tc_remark:'';
$tc_pramoted_class_in_word=isset($tc_all_data->tc_pramoted_class_in_word)?$tc_all_data->tc_pramoted_class_in_word:'';
$last_class_in_word1=isset($tc_all_data->last_class_in_word)?$tc_all_data->last_class_in_word:'';
$tc_student_category=isset($tc_all_data->tc_student_category)?$tc_all_data->tc_student_category:$getstudent->student_category;

$tc_aadhar_card=isset($tc_all_data->tc_aadhar_card)?$tc_all_data->tc_aadhar_card:'';
$tc_reg_no_class_9_to_12 = isset($tc_all_data->tc_reg_no_class_9_to_12)?$tc_all_data->tc_reg_no_class_9_to_12:'';
$tc_aadhar_card_mother=isset($tc_all_data->tc_aadhar_card_mother)?$tc_all_data->tc_aadhar_card_mother:'';
$tc_date_rolls1 = isset($tc_all_data->tc_date_rolls)?$tc_all_data->tc_date_rolls:'';
$tc_issue_date1 = isset($tc_all_data->tc_issue_date)?$tc_all_data->tc_issue_date:'';

$tc_date_first_admission1 = isset($tc_all_data->tc_date_first_admission)?$tc_all_data->tc_date_first_admission:'';
$tc_date_application1 = isset($tc_all_data->tc_date_application)?$tc_all_data->tc_date_application:'';
$tc_date_application = isset($tc_all_data->tc_date_application)?$tc_all_data->tc_date_application:'';
$tc_nationality=isset($tc_all_data->tc_nationality)?$tc_all_data->tc_nationality:'';
$tc_date_first_admission_class=isset($tc_all_data->tc_date_first_admission_class)?$tc_all_data->tc_date_first_admission_class:'';
$tc_whether_failed=isset($tc_all_data->tc_whether_failed)?$tc_all_data->tc_whether_failed:'';
$last_class_in_word=isset($tc_all_data->last_class_in_word)?$tc_all_data->last_class_in_word:'';
$tc_book_number=isset($tc_all_data->tc_book_number)?$tc_all_data->tc_book_number:'';
$tc_book_number=isset($tc_all_data->tc_book_number)?$tc_all_data->tc_book_number:'';
 
$last_tc=$this->dynamic_manage_model->get_dynamic_row_order_by('sb_transfar_certificate','tc_id','desc'); 
$last_tc_id=isset($last_tc->tc_id)?$last_tc->tc_id+1:1;
$tc_id=isset($tc_all_data->tc_id)?$tc_all_data->tc_id:$last_tc_id; 
$tc_id= str_pad ( $tc_id, 3, "0", STR_PAD_LEFT); 

if($last_class_in_word=="")
{
	$last_class_in_word=$getstudent->class_name;
} 

$tc_no_meetings=isset($tc_all_data->tc_no_meetings)?$tc_all_data->tc_no_meetings:'';

$tc_date_rolls=($tc_date_rolls1!='')?date('d-m-Y',strtotime($tc_date_rolls1)):'';



if(isset($tc_all_data->tc_dob)){
	$tc_dob=($tc_all_data->tc_dob=='' || $tc_all_data->tc_dob=='0000-00-00')?date("d-m-Y",strtotime($getstudent->student_dob)):date("d-m-Y",strtotime($tc_all_data->tc_dob));
}else{
	$tc_dob=date("d-m-Y",strtotime($getstudent->student_dob));
}
if(isset($tc_all_data->tc_parent_name)){
	$parent_guardian_name=($tc_all_data->tc_parent_name!='')?$tc_all_data->tc_parent_name:$getstudent->parent_father_name;
}else{
	$parent_guardian_name=$getstudent->parent_father_name;
}

if(isset($tc_all_data->tc_parent_name)){
	$parent_mother_name=($tc_all_data->tc_mother_name!='')?$tc_all_data->tc_mother_name:$getstudent->parent_mother_name;
}else{
	$parent_mother_name=$getstudent->parent_mother_name;
}
	   $student_religion = $getstudent->student_religion!="" ? $getstudent->student_religion :$tc_all_data->tc_religion;
	   $student_qid = $getstudent->student_qid!="" ? $getstudent->student_qid :'';
	$CI =& get_instance();
//}
// pre($tc_all_data);die;
?>
<style>
	.del-btn {color:#d73925;font-size:18px;cursor:pointer};

	.m-t-10{
		margin-top: 10px;
	}

	.m-t-20{
		margin-top: 20px;
	}

	.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
		border-top:1px solid #fff !important;
	}

	.ui-datepicker-calendar {
    	display: none;
    }
</style>
 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper wrapperminheight980px">
<!-- Content Header (Page header) -->
<section class="content-header marginbtm10">
  <h1 class="headtextstyle">
	Student Certificate
	<!--<small>Preview</small>-->
  </h1>
</section>
<div class="pull-left left15">
  <ol class="breadcrumb breadcrumb1">
	<li><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
	<li class="active">Student</li>
	<li class="active">Download Transfer Certificate</li>
  </ol>
</div> 
<!-- Main content -->
<section class="content content2">

<div class="box box1 box-default">
	<!-- /.box-header -->
	<div class="box-body">
		
		  <div class="row">
			<div class="col-md-12">
				<!-- <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#pendingInvoices">Student Certificates</a></li>
				</ul> -->

				<div class="tab-content">

					<div id="pendingInvoices" class="tab-pane fade in active" style="padding:10px;font-size: 15px;">
						<form method="post" id="staffForm" >
							
							<?php if(isset($getstudent) && !empty($getstudent)) { ?>
								<div class="row">
									<div class="col-sm-12">
										<div style="width:100%;margin-left:15px;margin:0px;"> 
											<div style="display:inline-block;width:17%;margin-bottom:20px;padding:0px;">
												<img src="<?= base_url() ?>/assets/images/school_images/school_<?= $school_data->school_pk_id ?>/<?=$school_data->school_logo?>" style="width: 150px;height: 100px;">
											</div>

											<div style="display:inline-block;vertical-align:top;width:69%;margin:0px;padding:0px;text-align:center">
										<!-- 		<h3 style="text-transform: uppercase;font-weight: bold;margin: 5px;"><?= $school_data->school_name ?></h3>
												<h3 style="margin: 5px; ">
													<?= $school_data->school_address ?> 
												</h3>
												<h3 style="margin: 5px; ">
													<?= $school_data->school_city ?> <?= $school_data->school_pincode ?> 
												</h3> -->

											 <p style=" ">
													Recognized by Ministry of Education & Higher Education, State of Qatar 
												</p>
												<h3 style="padding: 5px;">
													<span style="font-weight: bold;"> TRANSFER CERTIFICATE</span>
												</h3>
											</div> 
										</div>              
									</div>
									<div class="col-sm-12">
										<table class="table" style="width: 100%;">
											<tr>
												<td> CBSE Affiliation No. <?=$school_data->school_affliation_no;?> </td> 
												<!-- <td> School No. <?= $school_data->school_code; ?> </td> -->
												<!-- <td> 
													<p> 
														Book No: 
														<input type ="text" name="tc_transfer_book" value="<?=$tc_book_number;?>"> 
													</p>
												</td>  -->
											</tr>
											<tr>
												<td colspan="2">  Admission No <?=$getstudent->student_school_admission_no;?> </td>
												 
												<td> TC. No:<?=$sr_no; ?> </td>
										 
												
												 
											</tr>
										</table>

										<p>1. Name of the Pupil: <b><?=$getstudent->student_name; ?></b></p>
										<p>2.  Name Of Father: <b><?=$getstudent->parent_father_name; ?></b></p>
										<p>3.  Name Of Mother: <b><?=$getstudent->parent_mother_name; ?></b> </p>
										<p>4.  Religion & Nationality :
										
<select name="tc_religion" class="" id="tc_religion">
        <option value="" <?php echo ($student_religion == '') ? 'selected' : ''; ?>>--select--</option>
        <option value="hindu" <?php echo ($student_religion == 'hindu') ? 'selected' : ''; ?>>Hindu</option>
        <option value="muslim" <?php echo ($student_religion == 'muslim') ? 'selected' : ''; ?>>Muslim</option>
        <option value="sikh" <?php echo ($student_religion == 'sikh') ? 'selected' : ''; ?>>Sikh</option>
        <option value="jain" <?php echo ($student_religion == 'jain') ? 'selected' : ''; ?>>Jain</option>
        <option value="christian" <?php echo ($student_religion == 'christian') ? 'selected' : ''; ?>>Christian</option>
    </select>
											/
											<select name="tc_nationality">
												<?php foreach ($nationality as $key) { ?>
													<option value="<?= $key->nationality ?>" <?php if ($tc_nationality!='' && $key->nationality==$tc_nationality) { echo "selected";	}elseif($key->nationality=='Indian') { echo "selected"; } ?>  ><?= $key->nationality ?></option>
												<?php } ?>
											</select> 

										</p>
										<p>5. Date of Birth according to Admission register: <b><?=  date('d/m/Y',strtotime($tc_dob)) ?></b><br>
										  <!--  (in words): 
										   <b>
										   	<?php  
											   	$b_day=$CI->numberTowords(date("d",strtotime($tc_dob)));  
											   	$b_month=date("F",strtotime($tc_dob));  
											   	$b_year=$CI->numberTowords(date("Y",strtotime($tc_dob)));   
											   	echo ucfirst(strtolower($b_day)).' '.$b_month.' '.ucfirst(strtolower($b_year)); 
										   	?>
										   </b> -->
										 </p>
										
										<!-- <p>6.Whether the Candidate belongs Schedule Cast or Schedule Tribe: <input type="text" name="student_category" value="<?=$tc_student_category;?>"></p> -->
										
										 
										 <p>
										 	6. Date of First admission  with class in the Present school :
										 	<b>
										 		<input type="text" class="date_all" name="first_admission_date"  value="<?=date('d/m/Y',strtotime($getstudent->student_admission_date)); ?>" autocomplete="off"  >
										 	</b>
									 	  
									 		<!-- <input type="text" name="admission_class" value="<?= $tc_date_first_admission_class?>" placeholder="admission class" value="" autocomplete="off"> -->
									 	
										 	 
										 </p>
										 <p>7. Class in which the pupil last studied : 
                           <b> <input type="text" name="last_class_in_word"  value="<?=  $last_class_in_word; ?>" autocomplete="off"></b> 
                           <!-- 	<select class="from-control" name="admission_class" required>
									 			<option value="">--Select--</option>
									 			<?php foreach ($list_class as $key => $val_cls) {  ?>	
									 				<?php 
									 					$sel_adcls=($tc_date_first_admission_class==$val_cls['class_name'])?"selected":''; 
									 				?>	
									 				<option value="<?=$val_cls['class_name'];?>" <?=$sel_adcls;?>>
									 					<?=$val_cls['class_name'];?> 
									 				</option>
									 			<?php }  ?>	
									 		</select> -->
										 </p>
										
										  <p>8. Subjects studied: 
										 	      <?php  $tc_subjects=($tc_subjects!='')?json_decode($tc_subjects):array(); //pre($tc_subjects); ?>
										 	   <b>
										 	   		<?php 
										 	   			$sub_no=1; 
										 	   			foreach ($student_assign_subject as $key ) { echo '<br>'.$sub_no++.')'; ?>
                               
						                                <input type="checkbox" name="tc_subjects[]"  value="<?= $key['sb_main'] ?>" 
						                                <?php if (in_array($key['sb_main'],$tc_subjects)) {
						                                	echo 'checked';
						                                } ?>>
						                                <?php 
						                                	$subject_ass2 = preg_replace('/[0-9]+/', '', $key['sb_main']);
						                                ?>
						                                <?= strtoupper($subject_ass2); ?>
										 	      	<? } ?> 
										 	    </b> 
										 </p>
										 
										   <p>9. School examination last taken :  
										 	<b> <input type="text" name="tc_last_taken_result"  value="<?=  $tc_last_taken_result; ?>" autocomplete="off"></b> 
										 </p> 
										 <p>10. Whether failed, if so in the same class: <input type="text" name="tc_whether_failed" value="<?= $tc_whether_failed ?>"> </p> 
										
										 <p style="font-weight: normal;">
										 	 11. Whether qualified for promotion to higher class ?
									
												<input type="text" style = "width:100px;" id="is_promoted" name="is_promoted" value="<?php echo (isset($tc_all_data->tc_is_promoted_to_class))?$tc_all_data->tc_is_promoted_to_class : ''; ?>" class="validate[required]" placeholder="Yes/No">
										 If so, to, which class (in figures.)  
										<input type="text" style = "width:100px;" id="promoted_class_name" name="promoted_class_name" value="<?php echo (isset($tc_all_data->tc_promoted_class))?$tc_all_data->tc_promoted_class : ''; ?>" class="validate[required]" placeholder="Class Name">
										(in words)
										<input type="text" style = "width:100px;" id="promoted_class_name_inword" name="promoted_class_name_inword" value="<?php echo (isset($tc_all_data->tc_pramoted_class_in_word))?$tc_all_data->tc_pramoted_class_in_word : ''; ?>" class="validate[required]" placeholder="Class Name in words">

										 </p>
										 <p>
										 	12. Month  and Year up to which the pupil has paid School Fees:  
										 	<!-- <select name="tc_fees_paid_month">
										 	 	<option value="Yes" <?php if ($tc_fees_paid_month=='Yes') {echo "selected";	} ?>>Yes</option>
										 	 	<option value="No" <?php if ($tc_fees_paid_month=='No') {echo "selected";	} ?>>No</option>
										 	</select> --> 

										 	<input type="text" id="tc_fees_paid_month" name="tc_fees_paid_month" autocomplete="off"  data-date-format="MM-yyyy" class="form-control1 date_all1 date_pick datepicker" value="<?=$tc_fees_paid_month;?>"> 

										 </p>
										 <!-- <p>14. Any Fee concession available of :if so ,the nature of such concession: <b>NA</b>
										 </p> -->
										 <p>13. Total No of Working Days: <b> <input type="text" name="total_working_day" value="<?= $tc_working_days ?>" autocomplete="off"></b> </p>
										 <p>14. Total No of Working Days Attended: <b> <input type="text" name="total_working_day_persent" value="<?= $tc_working_days_present ?>" autocomplete="off"></b> </p>
										 <!-- <p>17. Whether NCC Cadet / Boy Scout / Girl Guide (Details) May Be given :   <b>NA</b>
										 </p>
										 <p>18. Games played or extracurricular activities in which the pupil usually took part (mention achievment level there in):   <b> <input type="text" name="tc_extra_activity" value="<?= $tc_extra_activity ?>" autocomplete="off"></b>
										 </p> -->
										 
										 <!-- <p>19.   Date on which pupil's name was struck off the rolls of the school: 
													<input type="text" class="date_all" name="tc_date_rolls"   value="<?php //echo $tc_date_rolls; ?>" >
										 </p> -->

										 <p>15.  Character & Conduct : 
										 <input  style="width: 80%;"type="text" name="tc_general_conduct"  value="<?=  isset($tc_all_data->tc_general_conduct)?$tc_all_data->tc_general_conduct:''   ?>" autocomplete="off">
  
										 </p>
										 <p>16.Date of application for Transfer Certificate :  
										 	<?php $tc_date_application1=($tc_date_application!='')?date('d/m/Y',strtotime($tc_date_application)): date('d/m/Y'); ?>
													<input type="text" class="date_all" name="tc_date_application"  value="<?=$tc_date_application1; ?>" autocomplete="off"  >
										 </p>

										 <p>17. Date of Issue for Transfer Certificate :  
										 	<?php $tc_issue_date=($tc_issue_date1!='')?date('d/m/Y',strtotime($tc_issue_date1)): date('d/m/Y'); ?>
													<input type="text" class="date_all" name="tc_issue_date"  value="<?=$tc_issue_date; ?>" autocomplete="off"  >
										 </p>

										 <p>18. Reason for leaving the School: 
										 	    <?php 
													// pre($student_category);
											    	$selected=$tc_reason_for_leaving_school;
												    	$options =array(
																''=>'--select--',
																'Class X Passout' => 'Class X Passout',
																'Class XII passout' => 'Class XII Passout',
																'DETAINED' => 'DETAINED',
																'Inactive' => 'Inactive',
																'Left' => 'Left',
																'New Admission Withdrawal' => 'New Admission Withdrawal',
																'Parent Request' => 'Parent Request',
																'Schooling Completed' => 'Schooling Completed',
																'Struck Off' => 'Struck Off',
																'Transfer Job' => 'Transfer Job',
																);
													$class_ids=array('class'=>' ','id'=>' ','required'=>'true');
													echo form_dropdown('tc_reason_for_leaving_school', $options, $selected, $class_ids);
												?>
										 </p>
										
										 
										 <p>19.  Remark,if any: 
										 	<input type="text" name="tc_remark" style="width: 80%;"  value="<?=  isset($tc_all_data->tc_remark)?$tc_all_data->tc_remark:''   ?>" autocomplete="off"> 
										 </p>

										 <p>20.  QID NO.of the Student: 
										 	<input type="text" name="tc_student_qid"   value="<?=$student_qid ?>" autocomplete="off"> 
										 </p>
										 
										 
										 
									</div>
									<br><br>
									  <div class="col-sm-12"style="padding: 30px;">
										   <p>Certified that the above information is in accordance with the school register.</p>

										</div>

									<?php 


										 $class1 = array(2,15,16);
									      $class2 = array(3,4,5,6,7);
									      $class3 = array(8,9,10);
									      $class4 = array(11,12,13,14,17,18);
									      $class5 = array(1);

									        $checked_by_sign = $sty ='';
									      if(in_array($stud_class_id, $class1)){
									          $checked_by_sign ='Gitika_sign.jpg';
									          $sty = 'width:100px;height:80px;';
									          $p_name = 'Gitika Sharma';
									          $head = '(Head-Pre-Primary school)';
									      }
									      if(in_array($stud_class_id, $class2)){
									          $checked_by_sign ='Seema_Nanda_sign.jpg';
									           $sty = 'width:100px;height:80px;';
									           $p_name = 'Seema Nanda';
									           $head = '(Head-Primary School)';
									      }
									      if(in_array($stud_class_id, $class3)){
									          $checked_by_sign ='Aparajita_sign1.jpg';
									           $sty = 'width:100px;height:80px;';
									           $p_name = 'Aparajita';
									           $head = '(Head-Middle School)';
									      }
									      if(in_array($stud_class_id, $class4)){
									          $checked_by_sign ='Seema_Kaushik.jpg';
									           $sty = 'width:100px;height:80px;';
									            $p_name = 'Seema Kaushik';
          										 $head = '(Head-Senior School)';
									      }
									      if(in_array($stud_class_id, $class5)){
									          $checked_by_sign ='nidhi_mam_signature.jpg';
									           $sty = 'width:100px;height:80px;';
									           $p_name = 'Nidhi Jethra';
									           $head = '(Registrar)';
									      }

									 ?>

									<div class="col-sm-12" style="margin-top:50px;" align="center">
										<table class="table">
											<tr>
												<td></td>
												<td style="text-align: center;">
													
												</td>
												<td style="text-align: right;"></td>
											</tr>
											<tr>

												 
												<td>  Prepared by </td>
												<!-- <td style="text-align: center;"> Checked By With Full Name and Designation  </td> -->
												<td style="text-align: right;">  Principal  </td>
											</tr>
										</table>
									</div>
 <div class=""style="width:100%;margin-top:100px;font-size:12px;text-align: center;">
                       <p style="padding:-5px">C.R No: 80656/2, PO Box: 22086, Building No:47, Street:980, Thumama, Doha, State of Qatar</p>
                       <p style="padding:-5px">Ph: +974 44584616 | Fax: +974 44171731</p>
                       <p style="padding:-5px">Email: info@oliveschooldoha.com Web: www.oliveschooldoha.com</p>

                    </div>
								</div>
							<?php } ?>

							<br><br>
									<!-- <div class="col-sm-12"style="padding: 30px;">
										 
										<p><b>Note:If,this T.C. is issued by the officiating/Incharge Principal, In variably countersigned by the manager V.M.C.</b></p>
									</div> -->

						<div class="col-sm-12 m-t-20"> </div> 

						<?php 
						 $send_btn="Download";
						 if(isset($move_to_tc)){
						 	if($move_to_tc==1){
						 		$send_btn="Move To TC";
						 		echo "<input type='hidden' value='1' name='move_to_tc'>";
						 	}
						 }	
						?>
						
						<div class="col-sm-12 m-t-20">  
							
							<input type="submit" id="save" class="btn btn-primary" name="submit" value="Save">
							
							<?php  if($is_send_email==1){  ?>
							<!-- 	<input style="margin-left: 10px;" type="submit" id="save" class="btn btn-info" name="submit" value="Finish & Email TC To Parent"> -->
							<?php } ?>
						</div>
						

						
						</form>
					</div>

					

				</div>
				  
				  
			 </div><!-- /.box -->
  	</div>
  	</div>
	
</section><!-- /.content -->
 

				 
</div><!-- /.box-body -->

  	
</div><!-- /.content-wrapper -->
<script>
$(function() {
	// $('.date_all').datepicker({
	// 	dateFormat: 'dd-mm-yy'
	// });

	$( ".date_all" ).datepicker({  format: 'dd/mm/yyyy' });
	// $( ".date_all1" ).datepicker({  format: 'MM/yyyy' });
	$("#tc_fees_paid_month_id").datepicker({  format: 'MM-yyyy' });

 
	$(".date_all1").datepicker( {
	    format: "MM yyyy",
	    viewMode: "months", 
	    minViewMode: "months"
	});


});

</script>


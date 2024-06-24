<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
/**
 * 
 */
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

class Tc_management extends CI_controller
{
  
  function __construct()
  {
      parent::__construct();
    $this->load->library('session');
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->library('image_lib');
    $this->load->model('Visitor_model');
    $this->load->model('feedback_model');
    $this->load->model('Student_model');
    $this->load->model('class_model');
    $this->load->model('tc_model');
    $this->load->model('student_model');
    $this->load->model('school_model');
    $this->load->model('exam_model');
    $this->load->model('dynamic_manage_model');
    $this->load->model('attendance_models/attendance_manage_model');

  } 
 
  public function tc_student_list(){
    $getSuccess = $this->uri->segment('3');
    $class_id1 = $this->uri->segment('4');
    $section_id1 = $this->uri->segment('5');
    $section_id = $this->uri->segment('5');
    $getClass = $this->class_model->getClass();
    $cid=$sid='';
    $select_class='';
    $select_section='';
    $student_list=array();
    $section_data=array();
    if((isset($class_id1) && $class_id1!='') && ($section_id1) && $section_id1!=''){
      $section_data = $this->Student_model->get_section_data($class_id1);
      $cid = $class_id1;
      $sid = $section_id1;
      $select_class=$class_id1;
      $select_section = $section_id1;
      $_SESSION['student_redirect_url'] = $class_id1.'/'.$section_id1;
    }elseif(isset($class_id1) && $class_id1!=''){
      $section_data = $this->Student_model->get_section_data($class_id1);
      $cid = $class_id1;
      $select_class=$class_id1;
      $_SESSION['student_redirect_url'] = $class_id1;
    }
    //$section_data = $this->student_model->get_section_data($_POST['class_id']); //print_r($section_data); die;
    if($cid == '99999'){
      $cid = '';
      $student_list = $this->Student_model->get_student_list($cid,$sid);
    }elseif($cid!=''){
      $student_list = $this->Student_model->get_student_list($cid,$sid);
    }

    // if(){

    // }

 
    $feedback_list = $this->Visitor_model->get_v_feedback_list(2);

    $sendData=array('student_list'=>$student_list,'section_data'=>$section_data ,'class'=>$getClass,'section_id'=>$section_id,'select_class'=>$select_class,'select_section'=>$select_section,'isSuccess'=>$getSuccess,'feedback_list'=>$feedback_list);
    self::slicing('tc_student_list',$sendData);
  }


  public function tc_taken_list(){
    $getSuccess = $this->uri->segment('3');
    $class_id1 = $this->uri->segment('4');
    $section_id1 = $this->uri->segment('5');
    $section_id = $this->uri->segment('5');
    $getClass = $this->class_model->getClass();
    $cid=$sid='';
    $select_class='';
    $select_section='';
    $student_list=array();
    $section_data=array();
    if((isset($class_id1) && $class_id1!='') && ($section_id1) && $section_id1!=''){
      $section_data = $this->Student_model->get_section_data($class_id1);
      $cid = $class_id1;
      $sid = $section_id1;
      $select_class=$class_id1;
      $select_section = $section_id1;
      $_SESSION['student_redirect_url'] = $class_id1.'/'.$section_id1;
    }elseif(isset($class_id1) && $class_id1!=''){
      $section_data = $this->Student_model->get_section_data($class_id1);
      $cid = $class_id1;
      $select_class=$class_id1;
      $_SESSION['student_redirect_url'] = $class_id1;
    }
    //$section_data = $this->student_model->get_section_data($_POST['class_id']); //print_r($section_data); die;
    if($cid == '99999'){
      $cid = '';
      $student_list = $this->tc_model->get_tc_list($cid,$sid);
    }elseif($cid!=''){
      $student_list = $this->tc_model->get_tc_list($cid,$sid);
    }

 
    $feedback_list = $this->Visitor_model->get_v_feedback_list(2);

    $sendData=array('student_list'=>$student_list,'section_data'=>$section_data ,'class'=>$getClass,'section_id'=>$section_id,'select_class'=>$select_class,'select_section'=>$select_section,'isSuccess'=>$getSuccess,'feedback_list'=>$feedback_list);
    self::slicing('tc_taken_list',$sendData);
  }

 





 
  function student_list_table(){
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    $search = $this->input->get("search");
    $order = $this->input->get("order");

    $cid=$this->input->get("class_id");
    $sid=$this->input->get("section_id");
    $stud_id='';
    $data=array();

    
    $num_rows ='1';
    if($cid =='99999'){ 
      $student_lists = $this->student_model->get_student_ajax($start,$length,$search,$order,5);
      $num_rows = $this->student_model->get_student_cnt($search,$start,$length,5);
    }elseif($cid !='99999' && $sid=='99999'){ 
      $student_lists = $this->student_model->get_student_ajax($start,$length,$search,$order,5,$cid);
      $num_rows = $this->student_model->get_student_cnt($search,$start,$length,5,$cid);
    }elseif($cid !='99999' && $sid!='99999'){ 
      $student_lists = $this->student_model->get_student_ajax($start,$length,$search,$order,5,$cid,$sid,$stud_id);
      $num_rows = $this->student_model->get_student_cnt($search,$start,$length,5,$cid,$sid);
    }
 
    if(count($student_lists) > 0) {
      $srno=1;$n=0;
      foreach($student_lists as $r) {  
        $student_pk_id=$r['student_pk_id'];
        $student_name=$r['student_name'];
        $cal_amt_unpaid1=$r['cal_amt_unpaid'];

        
                
        if(isset($r['details_photo']) && $r['details_photo']!=''){        
          $student_image='<img class="img-circle img-bordered-sm" src="'.base_url().'assets/images/student_profile/thumb/'.$r['details_photo'].'" width="50px" height="50px">';
        }else{
          $student_image='<img class="img-circle img-bordered-sm" src="'.base_url().'assets/images/profile.jpg" width="50px" height="50px">';
        }

        // pre($_SESSION);die;
        $stud_status='';
        if($_SESSION['super_logged_in']['SUPERADMIN_USER_TYPE'] !=4){  
          $stud_status='<a href="javascript:void(0)" class="text-center" onclick="status_change('.$r['student_pk_id'].','.$r['student_fk_status_id'].')" title=" '.$r['status'].'">';
        } 
        $status='';
        if($r['student_fk_status_id'] == '1') {  
          $status='Active';
          $stud_status.='<img src="'.base_url().'assets/images/greenstatus.png" width="20px;" height="20px">';
        } else { 
          $status='Inactive';
          $stud_status.='<img src="<?php echo $baseURl; ?>assets/images/redstatus.png" width="20px;" height="20px">';
        } 
        if($_SESSION['super_logged_in']['SUPERADMIN_USER_TYPE'] !=4){  
          $stud_status.='</a>';
        }

          $class_name=$this->student_model->get_class_name_byid($r['details_fk_class_id']); 
 
          if($cal_amt_unpaid1==0){
            $student_action=" <a href=".base_url()."tc_management/move_to_tc/".$r['student_pk_id']."/active class='btn btn-info'>
                    Prepare TC
                  </a>";

            $all_checked='<input type="checkbox" id="check['.$srno.']  class="selectedId" name="checkbox[]" 
                    value=" '.$r['student_pk_id'].'" />';
          }else{
            $student_action="<span style='color:red;'>Fees Dues</span>";
            $all_checked=$student_action;
          }

          /*$student_action="<a href='".base_url()."tc_management/move_to_tc/".$student_pk_id."/active' class='btn btn-info'>
                    Prepare TC
                  </a>";
          $all_checked='<input type="checkbox" id="check['.$srno.']  class="selectedId" name="checkbox[]" value="'.$student_pk_id.'"/>';*/

             

          $data[$n] = array(
          $all_checked,
          $srno,
                $student_image,
                $r['student_school_admission_no'],
                $r['details_roll_number'],
                $class_name,
                $r['section_name'],
                ucfirst($r['student_name']),
                ucfirst($r['parent_father_name']),
                ucfirst($r['parent_mother_name']),
                date("d/m/Y",strtotime($r['student_dob'])),
                $r['parent_guardian_email'],
                $r['parent_guardian_contact'],
                // ($r['student_allow_mail_send']=='1')?'Yes':'No',
                // ($r['parent_email_verify']=='1')?'Verified':'unverified',
                date("d/m/Y",strtotime($r['student_added_date'])),
                $status,
                $student_action,
              );
           
          $n++;
          $srno++;}
        }
      // pre($data,1);
      $output = array(
        "draw" => $draw,
        "recordsTotal" => $num_rows,
        "recordsFiltered" => $num_rows,
        "data" => $data
      );
      
      echo json_encode($output);  
  }

  function student_list_tc_taken_table(){
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $search = $this->input->get("search");
      $order = $this->input->get("order");

      $cid=$this->input->get("class_id");
      $sid=$this->input->get("section_id");
     $stud_id='';
     $data=array();

    
    // $num_rows ='1';


    // if($cid =='99999'){
    //     // echo "all"."<br>";
    //   $student_lists = $this->student_model->get_gtc_student_ajax($start,$length,$search,$order,5);
    //   $num_rows = $this->student_model->get_gtc_student_cnt($search,$start,$length,5);
    // }elseif($cid !='99999' && $sid=='99999'){
    //   // echo "class"."<br>";
    //   $student_lists = $this->student_model->get_gtc_student_ajax($start,$length,$search,$order,5,$cid);
    //   $num_rows = $this->student_model->get_gtc_student_cnt($search,$start,$length,5,$cid);
    // }elseif($cid !='99999' && $sid!='99999'){
    //   // echo "section"."<br>";
    //   $student_lists = $this->student_model->get_gtc_student_ajax($start,$length,$search,$order,5,$cid,$sid,$stud_id);
    //   $num_rows = $this->student_model->get_gtc_student_cnt($search,$start,$length,5,$cid,$sid);
    // }

      $student_lists = $this->student_model->get_gtc1_student_ajax($start,$length,$search,$order,$cid,$sid);
      $num_rows = $this->student_model->get_gtc1_student_cnt($search,$start,$length,$cid,$sid);
     // pre($student_lists,1);

    //  pre($cid);
    //  pre($sid,1);
    // // $num_rows = 100;
    //  if($cid !='99999' && $sid!='99999'){
    //    $num_rows = $this->student_model->get_student_cnt($search,$start,$length,$cid,$sid);
    //   }
    //  pre($num_rows,1);
    // pre($student_lists,1);
       $n=0; $srno=1;$num_rows1 = 0;
    if(count($student_lists) > 0) {
     
          foreach($student_lists as $r) {  
            // $tc_data = $this->tc_model->get_tc_data_by_id($r['student_pk_id']);
             
           //pre($r,1);
            // if(count($tc_data)>0){

              $num_rows1++;

              $tc_dob = '';
            // $tc_dob1=($tc_data->tc_dob=='' || $tc_data->tc_dob=='0000-00-00')?date("d-m-Y",strtotime($r['student_dob'])):date("d-m-Y",strtotime($tc_data->tc_dob));  
             // pre($tc_dob,1);
            $all_checked='<input type="checkbox" id="check['.$srno.']  class="selectedId" name="checkbox[]" 
                    value=" '.$r['student_pk_id'].'" />';
                    
            if(isset($r['details_photo']) && $r['details_photo']!=''){        
              $student_image='<img class="img-circle img-bordered-sm" src="'.base_url().'assets/images/student_profile/thumb/'.$r['details_photo'].'" width="50px" height="50px">';
            }else{
              $student_image='<img class="img-circle img-bordered-sm" src="'.base_url().'assets/images/profile.jpg" width="50px" height="50px">';
            }

            // pre($_SESSION);die;
            $stud_status='';
        if($_SESSION['super_logged_in']['SUPERADMIN_USER_TYPE'] !=4){  
          $stud_status='<a href="javascript:void(0)" class="text-center" onclick="status_change('.$r['student_pk_id'].','.$r['student_fk_status_id'].')" title=" '.$r['status'].'">';
        } 
        $status='';
        if($r['student_fk_status_id'] == '1') {  
          $status='Active';
          $stud_status.='<img src="'.base_url().'assets/images/greenstatus.png" width="20px;" height="20px">';
        } else { 
          $status='Active';
          $stud_status.='<img src="<?php echo $baseURl; ?>assets/images/redstatus.png" width="20px;" height="20px">';
        } 
        if($_SESSION['super_logged_in']['SUPERADMIN_USER_TYPE'] !=4){  
          $stud_status.='</a>';
        }

          $class_name=$this->student_model->get_class_name_byid($r['details_fk_class_id']); 

         $student_action1=" <a href=".base_url()."tc_management/move_to_tc/".$r['student_pk_id']."/inactive class='btn btn-info'>
                  Prepare TC 
                </a>";

          $student_action=" <a href=".base_url()."tc_management/download_tc/".$r['student_pk_id']." class='btn btn-info'>
                  Download TC
                </a>";

          $student_view_p='<a title="View Student" href='.base_url().'student/view_student/'.$r['student_pk_id'].'>
                              <img src="'.base_url().'assets/images/view.png" height="18" width="20" broder="0px">
                          </a>';   

           $student_back=' <a href="javascript:void(0)" onclick="back_to_student('.$r['student_pk_id'].',2)"
							   class="btn btn-danger">
								Back To Student List
							</a>';                   

           $all_action='<div style="width:400px;display:inline-block;"> 
                          '.$student_view_p.' | '.$student_action1.' |  '.$student_action.' | '.$student_back.'
                        </div>';   

               $tc_send_status =  '';
              if($r['tc_generate_status'] == 2){
                $tc_send_status =  'Sent';
              }  

              $data[$n] = array(
                 $all_checked,
                 $srno,
                $student_image,
                $r['student_school_admission_no'],
                $r['details_roll_number'],
                $class_name,
                $r['section_name'],
                ucfirst($r['student_name']),
                ucfirst($r['parent_father_name']),
                ucfirst($r['parent_mother_name']),
                date("d/m/Y",strtotime($r['student_dob'])),
                $r['parent_guardian_email'],
                $r['parent_guardian_contact'],
                // ($r['student_allow_mail_send']=='1')?'Yes':'No',
                // ($r['parent_email_verify']=='1')?'Verified':'unverified',
                date("d/m/Y",strtotime($r['student_added_date'])),
                $tc_send_status,
                 ($r['tc_date'] != '0000-00-00 00:00:00')?date("d/m/Y",strtotime($r['tc_date'])):'',
                // $status,
               $all_action,
              );
           
          $n++;
          $srno++;
        // pre($data);
      //  }
          }
          
        }
      // pre($data,1);
      $output = array(
        "draw" => $draw,
        "recordsTotal" => $num_rows,
        "recordsFiltered" => $num_rows,
        "data" => $data
      );
      
      echo json_encode($output);  
  }

 


 

  public function move_to_tc() {
      // pre($_POST,1);
  
      IsAdminActive();
      $student_id = $this->uri->segment('3');
      $red = $this->uri->segment('4');
      $with_header = 'header';

       // pre( $with_header);
       // pre( $student_id,1);
      $isheader=false;
      if($with_header == 'header'){
        $isheader=true;
      }
      $getstudent= $this->student_model->get_student_view_byid($student_id);
      $stud_class_id = $getstudent->details_fk_class_id;
     // pre($stud_class_id,1);
      $tc_sr_no_auto_g = $this->tc_model->get_tc_sr_no();
      $tc_sr_no = $this->tc_model->get_tc_sr_no_by_stud_id($student_id);



      // if(isset($tc_sr_no) && $tc_sr_no->tc_sr_no != ''){
      //     $sr_no = $tc_sr_no->tc_sr_no;
      // }else{
      //    if($tc_sr_no_auto_g->tc_sr_no != 0){
      //    $sr_no = $tc_sr_no_auto_g->tc_sr_no+1;
      // }else{
      //    $sr_no = 1;
      // }
      // }
     //pre($tc_sr_no);
     //pre($sr_no,1);
      // if(isset($tc_sr_no) && $tc_sr_no->tc_sr_no != ''){
      // }else{
      //   $res_no=$this->tc_model->get_tc_auto_generation_no_by_id(['tcagn_school_id'=>$getstudent->parent_fk_school_id]);
      //   $sr_no = $res_no->max_tc_no; 
      // }
     

      $tc_all_data=$this->tc_model->get_tc_data_by_id($student_id);


      $sr_no=isset($tc_all_data->tc_srno)?$tc_all_data->tc_srno:'';
      // pre($tc_all_data,1);

      if(trim($sr_no)==''){
        $res_no=$this->tc_model->get_tc_auto_generation_no_by_id(['tcagn_school_id'=>$getstudent->parent_fk_school_id]);
        $sr_no = $res_no->max_tc_no; 
      }

      if(empty($getstudent)){
         redirect(base_url().'student', 'refresh');
      }
      $school_data= $this->school_model->getSchool($getstudent->parent_fk_school_id);
      $pstData = array('student_id'=>$getstudent->details_pk_id,'class'=>$getstudent->details_fk_class_id,'section_id'=>$getstudent->details_fk_section_id);
      $getExamMrks = $this->class_model->get_report_exam_marks($pstData);
      $max = -999999;
      $exam_name= '';
      $Markslist = array();
      $passSts=$grade='';
      $subject_list = '';

      if(count($getExamMrks)>0){
        foreach($getExamMrks as $k=>$v)
          {
            if(strtotime($v[0]['marks_added_date'])>$max)
            {
               $max = strtotime($v[0]['marks_added_date']);
               $Markslist[] = $v;
               $ex = $this->exam_model->getExamName($k);
               $exam_name = $ex->exam_name;
            }
          }
          $total_max_marks = $total_passing_marks = $total_obtained_marks = 0;
          $i = 1;
          foreach($Markslist[0] as $mrKey => $mrVal){
            $total_max_marks = $total_max_marks+$mrVal['schedule_out_of_marks'];
            $total_passing_marks = $total_passing_marks + $mrVal['schedule_passing_marks'];
            $total_obtained_marks = $total_obtained_marks + $mrVal['marks_marks'];
            $subject_list .= $i.". ".preg_replace('/\d+/u', '', $mrVal['sub_main_name'])." ";
            $i++;
          }
          $rndMrk = round($total_obtained_marks);

          $rndMrk1=0;
          if($total_max_marks!=0){
            $rndMrk1 = round(($total_obtained_marks/$total_max_marks)*100);
          }
 
          $where3 = "$rndMrk1 BETWEEN grade_min_marks AND grade_max_marks";
          $this->db->select('grade_name');
          $getSqlRes = $this->db->get_where('grade',$where3);
          $gradeResult = $getSqlRes->row();
          $grade = isset($gradeResult->grade_name)?$gradeResult->grade_name:'';
          // pre($gradeResult,1);

          if($rndMrk<=$total_max_marks && $rndMrk>=$total_passing_marks)
          {
            $passSts = 'Pass with '.$grade.' Grade';
          } else {
            $passSts = 'Fail';
          }
        
      }
      
      $sof = (strtolower($getstudent->student_gender) == 'male')?'S/o':'D/o';
      $hisher = (strtolower($getstudent->student_gender) == 'male')?'his':'her';
      $heshe = (strtolower($getstudent->student_gender) == 'male')?'He':'She';
      $mamis = (strtolower($getstudent->student_gender) == 'male')?'Master':'Miss';
      $classes_word = array( 
        1 => "First", 
        2 => "Second", 
        3 => "Third", 
        4 => "Fourth", 
        5 => "Fifth", 
        6 => "Sixth", 
        7 => "Seventh", 
        8 => "Eighth", 
        9 => "Ninth", 
        10 => "Tenth", 
        11 => "Eleventh", 
        12 => "Twelvth"
      ); 
      $classNameinwords = (isset($classes_word[$getstudent->class_name]))?$classes_word[$getstudent->class_name]:$getstudent->class_name;
      $tc_dob='';

      // pre($_POST,1);

      if($this->input->post('submit') == 'Save') {
        // pre($_POST['tc_date_application'],1);
       
        $tc_issue_date=trim($_POST['tc_issue_date']); 
        $tc_date_application=trim($_POST['tc_date_application']); 
        if($tc_issue_date!=''){
          $tc_issue_date =  str_replace("/","-",trim($tc_issue_date));
          $tc_issue_date=date("Y-m-d",strtotime($tc_issue_date));
        }

        if($tc_date_application!=''){
          $tc_date_application =  str_replace("/","-",trim($tc_date_application));
          $tc_date_application=date("Y-m-d",strtotime($tc_date_application));
        }else{
          $tc_date_application=date("Y-m-d");
        }

        $student_id=$getstudent->student_pk_id;
         $tc_ins_data= array(  
                 'tc_student_id' =>$student_id,  
                 // 'tc_aadhar_card' =>$_POST['tc_aadhar_card'],  
                 // 'tc_aadhar_card_mother' =>$_POST['tc_aadhar_card_mother'],  
                 // 'tc_aadhar_card_father' =>$_POST['tc_aadhar_card_father'],  
                 'tc_nationality' =>$_POST['tc_nationality'],
                 // 'tc_student_category' =>$_POST['student_category'], 
                 // 'tc_first_admission_with_class' =>$_POST['first_admission_date'].'-'.$_POST['admission_class'],
                 'last_class_in_word' =>$_POST['last_class_in_word'], 
                 'tc_last_taken_result' =>$_POST['tc_last_taken_result'],
                 'tc_whether_failed' =>$_POST['tc_whether_failed'],
                  'tc_subjects' =>json_encode($_POST['tc_subjects']), 
                  // 'tc_pramoted_class_in_word' =>$_POST['tc_pramoted_class_in_word'], 
                  'tc_fees_paid_month' =>$_POST['tc_fees_paid_month'],
                   'tc_student_qid' =>$_POST['tc_student_qid'],
                   'tc_religion' =>$_POST['tc_religion'],
                  'tc_working_days'=>$_POST['total_working_day'],
                  'tc_working_days_present'=>$_POST['total_working_day_persent'],
                 // 'tc_date_rolls' =>($_POST['tc_date_rolls']!='')?date("Y-m-d",strtotime($_POST['tc_date_rolls'])):NULL,  
                  'tc_reason_for_leaving_school' =>$_POST['tc_reason_for_leaving_school'],
                   // 'tc_no_meetings' =>$_POST['tc_no_meetings'],  
                 'tc_general_conduct' =>$_POST['tc_general_conduct'],  
                 'tc_remark' =>$_POST['tc_remark'],  
                 'tc_issue_date' =>$tc_issue_date,  
                 'tc_generate_status' =>1,
                  // 'tc_extra_activity'=>$_POST['tc_extra_activity'],
                  'tc_fees_concession'=>'NA',
                  'tc_ncc'=>'NA',
                  //'tc_date_application'=>($_POST['tc_date_application']!='')?date("Y-m-d",strtotime($_POST['tc_date_application'])):NULL, 
                  // 'tc_date_first_admission_class'=>$_POST['admission_class'],
                  // 'tc_book_number'=>$_POST['tc_transfer_book'],
                  'tc_is_promoted_to_class'=>$_POST['is_promoted'],
                  'tc_promoted_class'=>$_POST['promoted_class_name'],
                  'tc_pramoted_class_in_word'=>$_POST['promoted_class_name_inword'], 
                  'tc_srno' =>$sr_no,
                  'tc_sr_no' =>$sr_no,
                  'tc_date_application' =>date('Y-m-d',strtotime($tc_date_application)),  
               ); 

         // pre($tc_ins_data,1);
        $res_uptc='';
        if(count($tc_all_data)==0){ 
          $this->tc_model->insert_all_tc_data_active_student($tc_ins_data,$student_id);

          $where_array=array('tcagn_school_id'=>$getstudent->parent_fk_school_id);
          $tbl_data=array('tcagn_tcnumber'=>$sr_no);
          $res_up=$this->tc_model->update_tc_auto_generation_no_by_id($tbl_data,$where_array);

          // pre($res_up);
        }else{
          if(trim($tc_all_data->tc_srno)==''){
            $where_array=array('tcagn_school_id'=>$getstudent->parent_fk_school_id);
            $tbl_data=array('tcagn_tcnumber'=>$sr_no);
            $res_up=$this->tc_model->update_tc_auto_generation_no_by_id($tbl_data,$where_array);
          }
          $res_uptc=$this->tc_model->update_all_tc_data($tc_ins_data,$student_id);
        }

        // pre($res_uptc,1);
        
      }

      if($this->input->post('submit') == 'Finish & Email TC To Parent'){

             $student_id=$getstudent->student_pk_id;
             $stud_data =  $this->tc_model->student_email_by_stud_id($student_id);
             $student_info=$this->tc_model->get_student_details_by_pk_id($student_id);

      foreach ($stud_data as  $value) {
          $mail_subject='Tc Generated Notification';
                    $mail_message='<div>
                                      Dear Parent,<br><br>                          

                                      Your request for Transfer Certificate for '.$student_info->student_name.' of '.$student_info->class_name.' - '.$student_info->section_name.' has been completed.<br>
                                      You can now download the certificate from the below link :-
                                      <br><br>
                                      <a href="'.base_url().'tc_management/download_tc/'.$value['student_pk_id'].'" class="btn btn-info">
                                        Download TC
                                      </a>
                                      
                                      </br><br>
           
                                   </div>';
                   //  $this->send_multi_email('salunket812@gmail.com',$mail_subject,$mail_message);
                      $this->send_multi_email($value['parent_guardian_email'],$mail_subject,$mail_message);
                  }

          $student_id=$getstudent->student_pk_id;
      

           $tc_ins_data= array(  
                 'tc_student_id' =>$student_id,  
                 // 'tc_aadhar_card' =>$_POST['tc_aadhar_card'],  
                 // 'tc_aadhar_card_mother' =>$_POST['tc_aadhar_card_mother'],  
                 // 'tc_aadhar_card_father' =>$_POST['tc_aadhar_card_father'],  
                 'tc_nationality' =>$_POST['tc_nationality'],
                 'tc_student_category' =>$_POST['student_category'], 
                 'tc_first_admission_with_class' =>$_POST['first_admission_date'].'-'.$_POST['admission_class'],
                 'last_class_in_word' =>$_POST['last_class_in_word'], 
                 'tc_last_taken_result' =>$_POST['tc_last_taken_result'],
                 'tc_whether_failed' =>$_POST['tc_whether_failed'],
                  'tc_subjects' =>json_encode($_POST['tc_subjects']),  
                  'tc_promoted_class' =>$_POST['tc_promoted_class'], 
                  'tc_fees_paid_month' =>$_POST['tc_fees_paid_month'],
                  'tc_student_qid' =>$_POST['tc_student_qid'],
                   'tc_religion' =>$_POST['tc_religion'],
                   // 'tc_fees_concession' =>$_POST['tc_fees_concession'],
                  'tc_working_days'=>$_POST['total_working_day'],
                  'tc_working_days_present'=>$_POST['total_working_day_persent'],
                 // 'tc_date_rolls' =>($_POST['tc_date_rolls']!='')?date("Y-m-d",strtotime($_POST['tc_date_rolls'])):NULL,  
                  'tc_reason_for_leaving_school' =>$_POST['tc_reason_for_leaving_school'],
                   'tc_no_meetings' =>$_POST['tc_no_meetings'],  
                 'tc_general_conduct' =>$_POST['tc_general_conduct'],  
                 'tc_remark' =>$_POST['tc_remark'],  
                 'tc_issue_date' =>($_POST['tc_issue_date']!='')?date("Y-m-d",strtotime($_POST['tc_issue_date'])):NULL,  
                 'tc_generate_status' =>1,
                  'tc_extra_activity'=>$_POST['tc_extra_activity'],
                  'tc_fees_concession'=>'NA',
                  'tc_ncc'=>'NA',
                  'tc_date_application'=>($_POST['tc_date_application']!='')?date("Y-m-d",strtotime($_POST['tc_date_application'])):NULL, 
                  'tc_date_first_admission_class'=>$_POST['admission_class'],
                  'tc_book_number'=>$_POST['tc_transfer_book'],
                 // 'tc_ncc' =>$_POST['tc_ncc'],  
                   
                 
                 // 'tc_reg_no_class_9_to_12' =>$_POST['tc_reg_no_class_9_to_12'],  
                 'tc_srno' =>$sr_no,
                 'tc_sr_no' =>$sr_no,
                 // 'tc_proof_of_date'=>$_POST['tc_proof_of_date'],
                 // 'tc_date_first_admission'=>($_POST['tc_date_first_admission']!='')?date("Y-m-d",strtotime($_POST['tc_date_first_admission'])):NULL,
                 // 'tc_date_first_admission_class'=>$_POST['tc_date_first_admission_class'],
                 // 'tc_extra_activity'=>$_POST['tc_extra_activity'],
                 // 'tc_date_application'=>($_POST['tc_date_application']!='')?date("Y-m-d",strtotime($_POST['tc_date_application'])):NULL,  
               );

                  if(isset($_POST['move_to_tc'])){
                  if($_POST['move_to_tc']==1){

                    

                    // if(count($tc_all_data)==0){
                    //   $this->tc_model->insert_all_tc_data($tc_ins_data,$student_id);
                    // }else{
                    //   $this->tc_model->update_all_tc_data($tc_ins_data,$student_id);
                    // }
                    $this->tc_model->update_all_tc_data($tc_ins_data,$student_id);
                    // if(count($tc_all_data)==0){
                    //   $this->tc_model->insert_all_tc_data($tc_ins_data,$student_id);
                    // }else{
                    //   $this->tc_model->update_all_tc_data($tc_ins_data,$student_id);
                    // }
                   

                       if($red == 'active'){
                    return $this->_flashdatacheck($success=1,
                     "Successfully Moved","Thanks you!","tc_management/tc_student_list");
                  }

                  if($red == 'inactive'){

                     return $this->_flashdatacheck($success=1,
                       "Successfully Moved","Thanks you!","tc_management/tc_taken_list");
                  }



                  }
                }
      }

      $nationality = $this->tc_model->fetch_nationality();

      $student_assign_subject = $this->tc_model->get_assign_sublist($student_id);
      $list_class = $this->class_model->getClass();
     // pre($student_assign_subject,1);
     $attendance=  $this->attendance_cal_by_stud_id($student_id);
     // pre($atten,1);
        $sendData = array(
            'getstudent'=>$getstudent,
            'school_data'=>$school_data[0],
            'exam_name'=>$exam_name,
            'result'=>$passSts,
            'subject_list'=>$subject_list,
            'classes_word'=>$classes_word,
             'move_to_tc'=>1 ,
             'tc_all_data'=>$tc_all_data,
             'srno'=>$sr_no,
             'sr_no'=>$sr_no,
             'tc_dob'=>$tc_dob,
             'nationality'=>$nationality,
             'student_assign_subject'=> $student_assign_subject,
             'stud_class_id'=>$stud_class_id,
             'is_send_email'=>1,
             'list_class'=>$list_class,
             'attendance'=>$attendance,
          );


        // echo "<pre>";
        // print_r($sendData);exit;
      //$this->load->view('superadmin/download_certificates',$sendData);
      self::slicing('download_transfer_certificates',$sendData);
      
  }

    function send_notification_tc_request(){

     $ids = $_POST['student_pk_id'];
     $stud_data =  $this->tc_model->student_email_by_stud_id($ids);

      foreach ($stud_data as  $value) {

         $student_info=$this->tc_model->get_student_details_by_pk_id($value['student_pk_id']);

          $mail_subject='Tc Generated Notification';
                       $mail_message='<div>
                                      Dear Parent,<br><br>                          

                                      Your request for Transfer Certificate for '.$student_info->student_name.' of '.$student_info->class_name.' - '.$student_info->section_name.' has been completed.<br>
                                      You can now download the certificate from the below link :-
                                      <br><br>
                                      <a href="'.base_url().'/tc_management/download_tc/'.$value['student_pk_id'].'" class="btn btn-info">
                                        Download TC
                                      </a>
                                      
                                      </br><br>
           
                                   </div>';
                  //   $this->send_multi_email('salunket812@gmail.com',$mail_subject,$mail_message);
                     $this->send_multi_email($value['parent_guardian_email'],$mail_subject,$mail_message);
                   }
                  echo 1;
    }

  function send_multi_email($to_email1,$mail_subject,$message=''){ 
     

      $getSchool = $this->school_model->getSchool(); 
      $schoolId = $getSchool[0]->school_pk_id;
      $schoolName = $getSchool[0]->school_name;
      $schoolLogo = $getSchool[0]->school_logo;
      $school_address = $getSchool[0]->school_address;

      if(isset($schoolLogo) && $schoolLogo!='' && file_exists(DOCUMENT_ROOT.'assets/images/school_images/school_'.$schoolId.'/'.$schoolLogo)){
        $logo = base_url()."assets/images/school_images/school_".$schoolId."/".$schoolLogo;
      }else{
        $logo = base_url()."assets/images/".web_app_logo; //echo $logo; exit;
      }

      $footer_logo = base_url()."assets/images/".web_app_footer_logo; //echo $footer_logo; exit; 
       
       
      $message.= "<br/><br/><br/>Thank you!<br/>For ".ucfirst($schoolName)."! <br>".web_app_name." Team"; 

      $message_body = file_get_contents(base_url().'assets/emailer/index.html');
      $message_body = str_replace('{logo}',$logo,$message_body);
      $message_body = str_replace('{message}',$message,$message_body);
      $message_body = str_replace('{school_name}',$schoolName,$message_body);
      $message_body = str_replace('{school_address}',$school_address,$message_body);
      $message_body = str_replace('{base_url}',base_url(),$message_body);
      $message_body = str_replace('{footer_logo}',$footer_logo,$message_body);
     
      $is_mail = send_email($to_email1,$mail_subject,$message_body); 
      return $is_mail;
  }
 


  function download_tc(){ 
      $student_id = $this->uri->segment('3');
      $with_header = 'header';

      
      $isheader=false;
      if($with_header == 'header'){
        $isheader=true;
      }
      $getstudent= $this->student_model->get_student_view_byid($student_id);

      $tc_all_data=$this->tc_model->get_tc_data_by_id($student_id);
      if(empty($getstudent)){
         redirect(base_url().'student', 'refresh');
      }
      $school_data= $this->school_model->getSchool($getstudent->parent_fk_school_id);
      $pstData = array('student_id'=>$getstudent->details_pk_id,'class'=>$getstudent->details_fk_class_id,'section_id'=>$getstudent->details_fk_section_id);

      //pre($getstudent->details_fk_class_id,1);

    
      $tc_sr_no_auto_g = $this->tc_model->get_tc_sr_no();
      $tc_sr_no = $this->tc_model->get_tc_sr_no_by_stud_id($student_id);


      if(isset($tc_sr_no) && $tc_sr_no->tc_sr_no != ''){
          $sr_no = $tc_sr_no->tc_sr_no;
      }else{
        if($tc_sr_no_auto_g->tc_sr_no != 0){
          $sr_no = $tc_sr_no_auto_g->tc_sr_no+1;
        }else{
          $sr_no = 1;
        }
      }

      $class1 = array(2,15,16);
      $class2 = array(3,4,5,6,7);
      $class3 = array(8,9,10);
      $class4 = array(11,12,13,14,17,18);
      $class5 = array(1);

        $checked_by_sign = $sty ='';
      if(in_array($getstudent->details_fk_class_id, $class1)){
          $checked_by_sign ='Gitika_sign.jpg';
          $sty = 'width:60px;height:50px;';
          $p_name = 'Gitika Sharma';
          $head = '(Head-Pre-Primary school)';
      }
      if(in_array($getstudent->details_fk_class_id, $class2)){
          $checked_by_sign ='Seema_Nanda_sign.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Seema Nanda';
           $head = '(Head-Primary School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class3)){
          $checked_by_sign ='Aparajita_sign1.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Aparajita';
           $head = '(Head-Middle School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class4)){
          $checked_by_sign ='Seema_Kaushik.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Seema Kaushik';
           $head = '(Head-Senior School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class5)){
          $checked_by_sign ='nidhi_mam_signature.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Nidhi Jethra';
           $head = '(Registrar)';
      }



      


      

      $getExamMrks = $this->class_model->get_report_exam_marks($pstData);
      $max = -999999;
      $exam_name= '';
      $Markslist = array();
      $passSts=$grade='';
      $subject_list = '';
      if(count($getExamMrks)>0){
        foreach($getExamMrks as $k=>$v)
          {
            if(strtotime($v[0]['marks_added_date'])>$max)
            {
               $max = strtotime($v[0]['marks_added_date']);
               $Markslist[] = $v;
               $ex = $this->exam_model->getExamName($k);
               $exam_name = $ex->exam_name;
            }
          }
          $total_max_marks = $total_passing_marks = $total_obtained_marks = 0;
          $i = 1;
          foreach($Markslist[0] as $mrKey => $mrVal){
            $total_max_marks = $total_max_marks+$mrVal['schedule_out_of_marks'];
            $total_passing_marks = $total_passing_marks + $mrVal['schedule_passing_marks'];
            $total_obtained_marks = $total_obtained_marks + $mrVal['marks_marks'];
            $subject_list .= $i.". ".preg_replace('/\d+/u', '', $mrVal['sub_main_name'])." ";
            $i++;
          }


          $rndMrk = round($total_obtained_marks);
          $rndMrk1 = 0;
          if($rndMrk != 0){   
              $rndMrk1 = round(($total_obtained_marks/$total_max_marks)*100);
          }
          $where3 = "$rndMrk1 BETWEEN grade_min_marks AND grade_max_marks";
          $this->db->select('grade_name');
          $getSqlRes = $this->db->get_where('grade',$where3);
          $gradeResult = $getSqlRes->row();
          $grade = isset($gradeResult->grade_name)?$gradeResult->grade_name:'';
          
          if($rndMrk<=$total_max_marks && $rndMrk>=$total_passing_marks)
          {
            $passSts = 'Pass with '.$grade.' Grade';
          } else {
            $passSts = 'Fail';
          }
        
      }
      
      $sof = (strtolower($getstudent->student_gender) == 'male')?'S/o':'D/o';
      $hisher = (strtolower($getstudent->student_gender) == 'male')?'his':'her';
      $heshe = (strtolower($getstudent->student_gender) == 'male')?'He':'She';
      $mamis = (strtolower($getstudent->student_gender) == 'male')?'Master':'Miss';
      $classes_word = array( 
        1 => "First", 
        2 => "Second", 
        3 => "Third", 
        4 => "Fourth", 
        5 => "Fifth", 
        6 => "Sixth", 
        7 => "Seventh", 
        8 => "Eighth", 
        9 => "Ninth", 
        10 => "Tenth", 
        11 => "Eleventh", 
        12 => "Twelvth"
      ); 
      // if($this->input->post()) {
      $get_tc_detail=$this->tc_model->get_tc_cer_details($student_id);

        // pre($get_tc_detail,1);
      $srno=isset($get_tc_detail->tc_srno)?$get_tc_detail->tc_srno:'';
      
        if($exam_name=='' && $passSts ==''){ 
          $exam_details =  isset($_POST['exam_details'])?$_POST['exam_details']:'';
           // $class_name = isset($get_tc_detail->tc_first_admission_with_class)?$get_tc_detail->tc_first_admission_with_class:'';
        }else{
          $exam_details = $exam_name.". ".$passSts;
        }
        if($subject_list=='')
        { 
          $subject_list =isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
        }

        $class_name = isset($get_tc_detail->tc_first_admission_with_class)?$get_tc_detail->tc_first_admission_with_class:'';
        $pass_fail = isset($get_tc_detail->tc_whether_failed)?$get_tc_detail->tc_whether_failed:'';
        $is_promoted = isset($get_tc_detail->tc_is_promoted_to_class)?$get_tc_detail->tc_is_promoted_to_class:'';
        $promoted_class_name = isset($get_tc_detail->tc_promoted_class)?$get_tc_detail->tc_promoted_class:'';
        $promoted_class_name_inword = isset($get_tc_detail->tc_promoted_class)?$get_tc_detail->tc_promoted_class:'';
        $fees_paid = isset($get_tc_detail->tc_fees_paid_month)?$get_tc_detail->tc_fees_paid_month:'';
        $concession_applicable = isset($get_tc_detail->tc_fees_concession)?$get_tc_detail->tc_fees_concession:'';
        $working_days = isset($get_tc_detail->tc_working_days)?$get_tc_detail->tc_working_days:'';
        $working_days_present = isset($get_tc_detail->tc_working_days_present)?$get_tc_detail->tc_working_days_present:'';
        $ncc = isset($get_tc_detail->tc_ncc)?$get_tc_detail->tc_ncc:'';
        $gmaes = isset($get_tc_detail->tc_extra_activity)?$get_tc_detail->tc_extra_activity:'';
        $general_conduct = isset($get_tc_detail->tc_general_conduct)?$get_tc_detail->tc_general_conduct:'';
        $tc_date_of_app_cert = isset($get_tc_detail->tc_date_of_app_cert)?$get_tc_detail->tc_date_of_app_cert:'';
        $tc_date_of_certificate = isset($get_tc_detail->tc_date_of_certificate)?$get_tc_detail->tc_date_of_certificate:'';
        $tc_subjects = isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
        $tc_book_number = isset($get_tc_detail->tc_book_number)?$get_tc_detail->tc_book_number:'';

 
        $tc_dob=($get_tc_detail->tc_dob=='' || $get_tc_detail->tc_dob=='0000-00-00')?date("d-m-Y",strtotime($getstudent->student_dob)):date("d-m-Y",strtotime($get_tc_detail->tc_dob));
        

        $app_date = $tc_date_of_app_cert;
        $issue_date = $tc_date_of_certificate;
        $tc_reason_for_leaving_school = isset($get_tc_detail->tc_reason_for_leaving_school)?$get_tc_detail->tc_reason_for_leaving_school:'';
        $tc_remark = isset($get_tc_detail->tc_remark)?$get_tc_detail->tc_remark:'';
        $classNameinwords = '';
        $classNameinwords = (isset($classes_word[$getstudent->class_name]))?$classes_word[$getstudent->class_name]:$getstudent->class_name;
        $last_class_in_word = isset($get_tc_detail->last_class_in_word)?$get_tc_detail->last_class_in_word:'';
        $tc_pramoted_class_in_word1 = isset($get_tc_detail->tc_pramoted_class_in_word)?$get_tc_detail->tc_pramoted_class_in_word:'';
        $tc_student_category = isset($get_tc_detail->tc_student_category)?$get_tc_detail->tc_student_category:'';
        $tc_last_taken_result = isset($get_tc_detail->tc_last_taken_result)?$get_tc_detail->tc_last_taken_result:'';

        $parent_guardian_name=($get_tc_detail->tc_parent_name!='')?$get_tc_detail->tc_parent_name:$getstudent->parent_father_name;
        $parent_mother_name=($get_tc_detail->tc_mother_name!='')?$get_tc_detail->tc_mother_name:$getstudent->parent_mother_name;
      $school_examinitation='';
      $last_tc=$this->dynamic_manage_model->get_dynamic_row_order_by('sb_transfar_certificate','tc_id','desc'); 
      $last_tc_id=isset($last_tc->tc_id)?$last_tc->tc_id+1:1;
      $tc_id=isset($tc_all_data->tc_id)?$tc_all_data->tc_id:$last_tc_id; 
      $tc_id= str_pad ( $tc_id, 3, "0", STR_PAD_LEFT);
      // pre($get_tc_detail,1);
      // pre($school_data,1);
     // require_once(APPPATH.'libraries/dompdf/dompdf_config.inc.php');
    //require_once(APPPATH.'libraries/dompdf082/autoload.inc.php');
        //$dompdf = new DOMPDF(); 
       // $dompdf = new Dompdf\Dompdf;

      require_once(APPPATH.'libraries/dompdf082/autoload.inc.php');
       
      $dompdf = new Dompdf\Dompdf;
      $font_family='serif';
        $html = $header = $body = "" ;

        $html="
         <head>
           <meta charset='UTF-8'>
         </head>
          ";

          $html .= "<style> span:after {
         content: '';
          font-size:10px;
         width: 100%;
         display: block;
         border-width: thin;
         font-size:serif;
       }

       th,td{
         padding-top:8px;

       }</style>" ;
        
        $html .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <div style="font-family:'.$font_family.' font-size:10px;;margin-top:0px;">

            <div style="margin:0px;padding:0px;">';
          if($isheader){
            $html.='<div style="width:100%;padding:-50px;margin-left:22px">  

                   
                        <img src="'.DOCUMENT_ROOT.'/assets/images//althumama.png" style="width:100%;height:auto">  

                        </div>
                   
                  
                  ';
          }


            $b_day=$this->numberTowords(date("d",strtotime($tc_dob)));  
            $b_month=date("F",strtotime($tc_dob));  
            $b_year=$this->numberTowords(date("Y",strtotime($tc_dob)));  

            $tc_date_rolls=($tc_all_data->tc_date_rolls!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_rolls)):'';
            $tc_issue_date=($tc_all_data->tc_issue_date!='')?date('d-m-Y',strtotime($tc_all_data->tc_issue_date)):'';

            $tc_date_application=($tc_all_data->tc_date_application!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_application)):'';

            $tc_date_first_admission=($tc_all_data->tc_date_first_admission!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_first_admission)):'';
            
            $tc_sr_no=($tc_all_data->tc_sr_no!='')?$tc_all_data->tc_sr_no:'';
            $tc_id=($tc_all_data->tc_id!='')?$tc_all_data->tc_id:'';
            $tc_subjects = isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
            $tc_subjects=($tc_subjects!='')?json_decode($tc_subjects):array(); 
            $sub_no=1; 
            $tc_sub_list='';
            foreach($tc_subjects as $subject_ass1){  
              $subject_ass2 = preg_replace('/[0-9]+/', '', $subject_ass1);
              $tc_sub_list .='<b>'.$sub_no.') '.strtoupper($subject_ass2) .' </b>';
              $sub_no++;
            }

            $html .= '</div>
                <div style="width:100%;margin-top:50px;padding-top:2px;text-align:center; font-size:12px;"> 
                  <b>
                        Recognized by Ministry of Education & Higher Education, State of Qatar</b>
                </div>
                <div style="width:100%;margin-top:px;padding-top:5px;text-align:center;"> 
                  <b>TRANSFER CERTIFICATE</b>
                </div>
              ';
   // pre($tc_all_data,1);
    $html .= ' <div style="width:100%;margin-left:0px;margin-top:0px;">
             
              <div style="text-align:center">
              <h4 style="margin:0px;padding:3px;text-align:center"></h4>
              <div>
             

            <div style="font-size:14px;padding-top:20px;">
            <table style="width:100%;">
            <tr> 
              <th style="width:50%;">CBSE Affiliation No. '.$school_data[0]->school_affliation_no.'<th>
             
            </tr>
            </table> 
            <table style="width:100%;margin_bottom:20px">
            <tr>  <th style="width:60%;text-align:left">Admission No. '.$getstudent->student_school_admission_no.'</th>

               <th style="width:40%;text-align:left">TC No. '.$tc_sr_no  .'</th>
            </tr>
            </table> 


            <table style="width:100%;">
            <tr>
            <th style="width:60%;">1. Name of the Pupil   </th>
            <td colspan="3" style="text-align:left"><span><b>'.strtoupper($getstudent->student_name).'</b></span></td>
            </tr>
            </table>
              
            <table style="width:100%;">
            <tr>
            <th style="width:60%;">2. Name of the Father   </th>
            <td colspan="3" style="text-align:left"><span><b>'.strtoupper($getstudent->parent_father_name).'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">3. Name of the Mother   </th>
            <td colspan="3" style="text-align:left"><span><b>'.strtoupper($getstudent->parent_mother_name).'</b></span></td>
            </tr>
            </table>

             <table style="width:100%;">
            <tr>
            <th style="width:60%;">4. Religion & Nationality   </th>
            <td colspan="3" style="text-align:left"><span><b>'.strtoupper($tc_all_data->tc_religion).'</b><b>'.strtoupper($tc_all_data->tc_nationality).'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">5.Date of Birth according to Admission   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_dob.'</b></span></td>
            </tr>
            </table>

          

           
          
            <table style="width:100%;">
            <tr>
            <th style="width:50%;">6. Date of First admission  with class in the Present school </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_first_admission_with_class.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">7.Class in which the pupil last studied     </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->last_class_in_word.'</b></span></td>
            </tr>
            </table>

           

         

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">8. Subject studied   </th>
            <td colspan="3" style="text-align:left">
              <span>
                <b>'.$tc_sub_list.'</b>
              </span>
            </td>
            </tr>
            </table>
 <table style="width:100%;">
            <tr>
            <th style="width:60%;">9. School  examination last taken   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_last_taken_result.'</b></span></td>
            </tr>
            </table>
            

               <table style="width:100%;">
            <tr>
            <th style="width:60%;">10. Whether failed, if so, in which class   </th>
            <td colspan="3" style="text-align:left"><span><b> '.$tc_all_data->tc_whether_failed.' </b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
              <tr>
                <th style="width:60%;">11. Whether qualified for promotion to higher class ?  </th>
                <th style="width:40%;"> 
                 '.$tc_all_data->tc_is_promoted_to_class.'  
                </th>
                
              </tr>
              <tr>

              <th>&nbsp;&nbsp;&nbsp;&nbsp; If so to which class (in words) </th>
                <td style="text-align:left;style="width:">  
                   <b>'.$tc_all_data->tc_promoted_class.',   '.$tc_all_data->tc_pramoted_class_in_word.'</b>
                </td>
                </tr>
            </table>
          

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">12.Month  and Year up to which the pupil has paid School Fees  </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_fees_paid_month.'</b></span></td>
            </tr>
            </table>

           
            <table style="width:100%;">
            <tr>
            <th style="width:60%;">13. Total No of Working Days   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_working_days.' </b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">14. Total No of Working Days Present   </th>
            <td colspan="3" style="text-align:left"><span><b> '.$tc_all_data->tc_working_days_present.'</b></span></td>
            </tr>
            </table>


            <table style="width:100%;">
            <tr>
            <th style="width:60%;">15. General conduct  </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_general_conduct.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">16. Date of application for Transfer Certificate  </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_date_application.'</b></span></td>
            </tr>
            </table>

             <table style="width:100%;">
            <tr>
            <th style="width:60%;">17. Date of Issue for Transfer Certificate   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_issue_date.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">18. Reason for leaving the School   </th>
            <td colspan="3" style="text-align:left">
              <span>
                <b>'.$tc_all_data->tc_reason_for_leaving_school.'</b>
              </span>
            </td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:60%;">19. Any Other remark   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_remark.'</b></span></td>
            </tr>
            </table>
          <table style="width:100%;">
            <tr>
            <th style="width:60%;">20. QID NO. of the student   </th>
            <td colspan="3" style="text-align:left"><span><b>'.$tc_all_data->tc_student_qid.'</b></span></td>
            </tr>

            
            </table>
 <p style="text-align:left">Certified that the above information is in accordance with the school register.</p>

          
            </div>
 
          </div>';

           $html.='
             <table style="width:100%;margin-top:50px;margin-bottom:auto">
            <tr>
            <th style="width:77%; font-size:12px">Prepared by  </th>
            <th></th>
           
            <th></th>
            <th style="width:%;font-size:12px;text-align:center">Principal  </th>
            
            </tr>
            </table>


          ';

            $html.='<div style="width:100%;padding-top:100px;padding:-50px;margin-left:22px;margin-top:87px">  

                   
                        <img src="'.DOCUMENT_ROOT.'/assets/images//althumama_footer.png" style="width:100%;height:auto">  

                        </div>
                   
                  
                  ';

          //         $html.='
          //      <div class=""style="width:100%;margin-top:auto;font-size:12px;">
          //              <p style="padding:-5px">C.R No: 80656/2, PO Box: 22086, Building No:47, Street:980, Thumama, Doha, State of Qatar</p>
          //              <p style="padding:-5px">Ph: +974 44584616 | Fax: +974 44171731</p>
          //              <p style="padding:-5px">Email: info@oliveschooldoha.com Web: www.oliveschooldoha.com</p>

          //           </div>
          // ';
     

        // <img src="'.base_url('assets/images/School_Stamp_RM.png').'"style="width:70px;height:70px;">
        
        //$html = $html.$header.$body;
           $html= mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
                //echo $html; die;
         

        $paper_size = array(8.5, 11, 620, 920); 
        $dompdf->set_paper($paper_size);
        //$dompdf->set_paper('a4','portrait');
        $dompdf->load_html($html);
        $dompdf->render();
        $date = date("d-m-Y-H:i:s-A");
        ob_end_clean();
        // $dompdf->stream("Transfer_certificate".$date.".pdf");
        $dompdf->stream("Transfer_certificate".$date.".pdf", array("Attachment" =>0));
        // $pdf = $dompdf->output();
  }function download_tc_old(){  
      $student_id = $this->uri->segment('3');
      $with_header = 'header';

      
      $isheader=false;
      if($with_header == 'header'){
        $isheader=true;
      }
      $getstudent= $this->student_model->get_student_view_byid($student_id);

      $tc_all_data=$this->tc_model->get_tc_data_by_id($student_id);
      if(empty($getstudent)){
         redirect(base_url().'student', 'refresh');
      }
      $school_data= $this->school_model->getSchool($getstudent->parent_fk_school_id);
      $pstData = array('student_id'=>$getstudent->details_pk_id,'class'=>$getstudent->details_fk_class_id,'section_id'=>$getstudent->details_fk_section_id);

      //pre($getstudent->details_fk_class_id,1);
      $tc_sr_no_auto_g = $this->tc_model->get_tc_sr_no();
      $tc_sr_no = $this->tc_model->get_tc_sr_no_by_stud_id($student_id);



      if(isset($tc_sr_no) && $tc_sr_no->tc_sr_no != ''){
          $sr_no = $tc_sr_no->tc_sr_no;
      }else{
        if($tc_sr_no_auto_g->tc_sr_no != 0){
          $sr_no = $tc_sr_no_auto_g->tc_sr_no+1;
        }else{
          $sr_no = 1;
        }
      }

      $class1 = array(2,15,16);
      $class2 = array(3,4,5,6,7);
      $class3 = array(8,9,10);
      $class4 = array(11,12,13,14,17,18);
      $class5 = array(1);

        $checked_by_sign = $sty ='';
      if(in_array($getstudent->details_fk_class_id, $class1)){
          $checked_by_sign ='Gitika_sign.jpg';
          $sty = 'width:60px;height:50px;';
          $p_name = 'Gitika Sharma';
          $head = '(Head-Pre-Primary school)';
      }
      if(in_array($getstudent->details_fk_class_id, $class2)){
          $checked_by_sign ='Seema_Nanda_sign.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Seema Nanda';
           $head = '(Head-Primary School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class3)){
          $checked_by_sign ='Aparajita_sign1.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Aparajita';
           $head = '(Head-Middle School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class4)){
          $checked_by_sign ='Seema_Kaushik.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Seema Kaushik';
           $head = '(Head-Senior School)';
      }
      if(in_array($getstudent->details_fk_class_id, $class5)){
          $checked_by_sign ='nidhi_mam_signature.jpg';
           $sty = 'width:60px;height:50px;';
           $p_name = 'Nidhi Jethra';
           $head = '(Registrar)';
      }



      


      

      $getExamMrks = $this->class_model->get_report_exam_marks($pstData);
      $max = -999999;
      $exam_name= '';
      $Markslist = array();
      $passSts=$grade='';
      $subject_list = '';
      if(count($getExamMrks)>0){
        foreach($getExamMrks as $k=>$v)
          {
            if(strtotime($v[0]['marks_added_date'])>$max)
            {
               $max = strtotime($v[0]['marks_added_date']);
               $Markslist[] = $v;
               $ex = $this->exam_model->getExamName($k);
               $exam_name = $ex->exam_name;
            }
          }
          $total_max_marks = $total_passing_marks = $total_obtained_marks = 0;
          $i = 1;
          foreach($Markslist[0] as $mrKey => $mrVal){
            $total_max_marks = $total_max_marks+$mrVal['schedule_out_of_marks'];
            $total_passing_marks = $total_passing_marks + $mrVal['schedule_passing_marks'];
            $total_obtained_marks = $total_obtained_marks + $mrVal['marks_marks'];
            $subject_list .= $i.". ".preg_replace('/\d+/u', '', $mrVal['sub_main_name'])." ";
            $i++;
          }


          $rndMrk = round($total_obtained_marks);
          $rndMrk1 = 0;
          if($rndMrk != 0){   
              $rndMrk1 = round(($total_obtained_marks/$total_max_marks)*100);
          }
          $where3 = "$rndMrk1 BETWEEN grade_min_marks AND grade_max_marks";
          $this->db->select('grade_name');
          $getSqlRes = $this->db->get_where('grade',$where3);
          $gradeResult = $getSqlRes->row();
          $grade = isset($gradeResult->grade_name)?$gradeResult->grade_name:'';
          
          if($rndMrk<=$total_max_marks && $rndMrk>=$total_passing_marks)
          {
            $passSts = 'Pass with '.$grade.' Grade';
          } else {
            $passSts = 'Fail';
          }
        
      }
      
      $sof = (strtolower($getstudent->student_gender) == 'male')?'S/o':'D/o';
      $hisher = (strtolower($getstudent->student_gender) == 'male')?'his':'her';
      $heshe = (strtolower($getstudent->student_gender) == 'male')?'He':'She';
      $mamis = (strtolower($getstudent->student_gender) == 'male')?'Master':'Miss';
      $classes_word = array( 
        1 => "First", 
        2 => "Second", 
        3 => "Third", 
        4 => "Fourth", 
        5 => "Fifth", 
        6 => "Sixth", 
        7 => "Seventh", 
        8 => "Eighth", 
        9 => "Ninth", 
        10 => "Tenth", 
        11 => "Eleventh", 
        12 => "Twelvth"
      ); 
      // if($this->input->post()) {
      $get_tc_detail=$this->tc_model->get_tc_cer_details($student_id);

        // pre($get_tc_detail,1);
      $srno=isset($get_tc_detail->tc_srno)?$get_tc_detail->tc_srno:'';
      
        if($exam_name=='' && $passSts ==''){ 
          $exam_details =  isset($_POST['exam_details'])?$_POST['exam_details']:'';
           // $class_name = isset($get_tc_detail->tc_first_admission_with_class)?$get_tc_detail->tc_first_admission_with_class:'';
        }else{
          $exam_details = $exam_name.". ".$passSts;
        }
        if($subject_list=='')
        { 
          $subject_list =isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
        }

        $class_name = isset($get_tc_detail->tc_first_admission_with_class)?$get_tc_detail->tc_first_admission_with_class:'';
        $pass_fail = isset($get_tc_detail->tc_whether_failed)?$get_tc_detail->tc_whether_failed:'';
        $is_promoted = isset($get_tc_detail->tc_is_promoted_to_class)?$get_tc_detail->tc_is_promoted_to_class:'';
        $promoted_class_name = isset($get_tc_detail->tc_promoted_class)?$get_tc_detail->tc_promoted_class:'';
        $promoted_class_name_inword = isset($get_tc_detail->tc_promoted_class)?$get_tc_detail->tc_promoted_class:'';
        $fees_paid = isset($get_tc_detail->tc_fees_paid_month)?$get_tc_detail->tc_fees_paid_month:'';
        $concession_applicable = isset($get_tc_detail->tc_fees_concession)?$get_tc_detail->tc_fees_concession:'';
        $working_days = isset($get_tc_detail->tc_working_days)?$get_tc_detail->tc_working_days:'';
        $working_days_present = isset($get_tc_detail->tc_working_days_present)?$get_tc_detail->tc_working_days_present:'';
        $ncc = isset($get_tc_detail->tc_ncc)?$get_tc_detail->tc_ncc:'';
        $gmaes = isset($get_tc_detail->tc_extra_activity)?$get_tc_detail->tc_extra_activity:'';
        $general_conduct = isset($get_tc_detail->tc_general_conduct)?$get_tc_detail->tc_general_conduct:'';
        $tc_date_of_app_cert = isset($get_tc_detail->tc_date_of_app_cert)?$get_tc_detail->tc_date_of_app_cert:'';
        $tc_date_of_certificate = isset($get_tc_detail->tc_date_of_certificate)?$get_tc_detail->tc_date_of_certificate:'';
        $tc_subjects = isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
        $tc_book_number = isset($get_tc_detail->tc_book_number)?$get_tc_detail->tc_book_number:'';

 
        $tc_dob=($get_tc_detail->tc_dob=='' || $get_tc_detail->tc_dob=='0000-00-00')?date("d-m-Y",strtotime($getstudent->student_dob)):date("d-m-Y",strtotime($get_tc_detail->tc_dob));
        

        $app_date = $tc_date_of_app_cert;
        $issue_date = $tc_date_of_certificate;
        $tc_reason_for_leaving_school = isset($get_tc_detail->tc_reason_for_leaving_school)?$get_tc_detail->tc_reason_for_leaving_school:'';
        $tc_remark = isset($get_tc_detail->tc_remark)?$get_tc_detail->tc_remark:'';
        $classNameinwords = '';
        $classNameinwords = (isset($classes_word[$getstudent->class_name]))?$classes_word[$getstudent->class_name]:$getstudent->class_name;
        $last_class_in_word = isset($get_tc_detail->last_class_in_word)?$get_tc_detail->last_class_in_word:'';
        $tc_pramoted_class_in_word1 = isset($get_tc_detail->tc_pramoted_class_in_word)?$get_tc_detail->tc_pramoted_class_in_word:'';
        $tc_student_category = isset($get_tc_detail->tc_student_category)?$get_tc_detail->tc_student_category:'';
        $tc_last_taken_result = isset($get_tc_detail->tc_last_taken_result)?$get_tc_detail->tc_last_taken_result:'';

        $parent_guardian_name=($get_tc_detail->tc_parent_name!='')?$get_tc_detail->tc_parent_name:$getstudent->parent_father_name;
        $parent_mother_name=($get_tc_detail->tc_mother_name!='')?$get_tc_detail->tc_mother_name:$getstudent->parent_mother_name;
      $school_examinitation='';
      $last_tc=$this->dynamic_manage_model->get_dynamic_row_order_by('sb_transfar_certificate','tc_id','desc'); 
      $last_tc_id=isset($last_tc->tc_id)?$last_tc->tc_id+1:1;
      $tc_id=isset($tc_all_data->tc_id)?$tc_all_data->tc_id:$last_tc_id; 
      $tc_id= str_pad ( $tc_id, 3, "0", STR_PAD_LEFT);
      // pre($get_tc_detail,1);
      // pre($school_data,1);
     // require_once(APPPATH.'libraries/dompdf/dompdf_config.inc.php');
    //require_once(APPPATH.'libraries/dompdf082/autoload.inc.php');
        //$dompdf = new DOMPDF(); 
       // $dompdf = new Dompdf\Dompdf;

      require_once(APPPATH.'libraries/dompdf082/autoload.inc.php');
       
      $dompdf = new Dompdf\Dompdf;
      $font_family='ARJUN';
        $html = $header = $body = "" ;

        $html="
         <head>
           <meta charset='UTF-8'>
         </head>
          ";

          $html .= "<style> span:after {
         content: '';
         border-bottom: 1px solid #000;
         width: 100%;
         display: block;
         border-width: thin;
       }
       th,td{
         padding-top:5px;
       }</style>" ;
        
        $html .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <div style="font-family:'.$font_family.';margin-left:15px;margin-top:20px;"><div style="margin:0px;padding:0px;">';
          if($isheader){
            $html.='<div style="width:100%;margin-top:-40px;text-align:center;">  
                        <img src="'.DOCUMENT_ROOT.'/assets/images/head_school_image2.jpeg" style="width:90%;height:110px;">  
                    </div>
                    <div style="width:100%;margin-top:10px;padding-top:1px;text-align:center;"> 
                      '.$school_data[0]->school_address.'
                    </div>
                  ';
          }


            $b_day=$this->numberTowords(date("d",strtotime($tc_dob)));  
            $b_month=date("F",strtotime($tc_dob));  
            $b_year=$this->numberTowords(date("Y",strtotime($tc_dob)));  

            $tc_date_rolls=($tc_all_data->tc_date_rolls!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_rolls)):'';
            $tc_issue_date=($tc_all_data->tc_issue_date!='')?date('d-m-Y',strtotime($tc_all_data->tc_issue_date)):'';

            $tc_date_application=($tc_all_data->tc_date_application!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_application)):'';

            $tc_date_first_admission=($tc_all_data->tc_date_first_admission!='')?date('d-m-Y',strtotime($tc_all_data->tc_date_first_admission)):'';
            
            $tc_sr_no=($tc_all_data->tc_sr_no!='')?$tc_all_data->tc_sr_no:'';
            $tc_id=($tc_all_data->tc_id!='')?$tc_all_data->tc_id:'';
            $tc_subjects = isset($get_tc_detail->tc_subjects)?$get_tc_detail->tc_subjects:'';
            $tc_subjects=($tc_subjects!='')?json_decode($tc_subjects):array(); 
            $sub_no=1; 
            $tc_sub_list='';
            foreach($tc_subjects as $subject_ass1){  
              $subject_ass2 = preg_replace('/[0-9]+/', '', $subject_ass1);
              $tc_sub_list .='<b>'.$sub_no.') '.strtoupper($subject_ass2) .' </b>';
              $sub_no++;
            }

            $html .= '</div>
                <div style="width:100%;margin-top:2px;padding-top:2px;text-align:center;"> 
                  <b>(AFFILIATED TO CENTRAL BOARD OF SECONDARY EDUCATION)</b>
                </div>
                <div style="width:100%;margin-top:5px;padding-top:5px;text-align:center;"> 
                  <u><b>TRANSFER CERTIFICATE</b></u>
                </div>
                <hr>';
   // pre($tc_all_data,1);
    $html .= ' <div style="width:100%;margin-left:0px;margin-top:0px;">
             
              <div style="text-align:center">
              <h4 style="margin:0px;padding:3px;text-align:center"></h4>
              <div>
             

            <div style="font-size:14px;padding-top:0px;">
            <table style="width:100%;">
            <tr> 
              <th style="width:40%;">CBSE Affiliation No. :  <u>'.$school_data[0]->school_affliation_no.'</u> <th>
              <th style="width:35%;text-align:left">School Code : <u>'.$school_data[0]->school_code.'</u></th>
            </tr>
            </table> 
            <table style="width:100%;">
            <tr> 
              <th style="width:33%;">Book No. :  <u>'.$tc_book_number.' </u> <th>
              <th style="width:34%;text-align:left">Sl No : <u> '. get_current_edu_session().' /CB/'.  $tc_sr_no  .'</u></th>
              <th style="width:33%;text-align:left">Admission No : <u>'.$getstudent->student_school_admission_no.'</u></th>
            </tr>
            </table> 
            <table style="width:100%;">
            <tr>
            <th style="width:400%;">1. Name of the Pupil:  </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($getstudent->student_name).'</b></span></td>
            </tr>
            </table>
              
            <table style="width:100%;">
            <tr>
            <th style="width:40%;">2. Name of the Father:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($getstudent->parent_mother_name).'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:40%;">3. Name of the Mother:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($getstudent->parent_father_name).'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:65%;">4.Date of Birth according to Admission:  </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_dob.'</b></span></td>
            </tr>
            </table>

          

            <table style="width:100%;">
            <tr>
            <th style="width:20%;">5. Nationality:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($tc_all_data->tc_nationality).'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:65%;">6. Whether the Candidate belongs Schedule Cast or Schedule Tribe:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_student_category.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:45%;">7. Date of First admission in the school with class:</th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_first_admission_with_class.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:45%;">8. Class in which the pupil last studied (in figures):   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->last_class_in_word.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:55%;">9. School/Board Annual examination last taken with result:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_last_taken_result.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:50%;">10. Whether failed, if so once/twice in the same class:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_whether_failed.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:20%;">11. Subject studied:   </th>
            <td colspan="3" style="text-align:left">
              <span>
                <b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_sub_list.'</b>
              </span>
            </td>
            </tr>
            </table>

            <table style="width:100%;">
              <tr>
                <th style="width:50%;">12. Whether qualified for promotion to higher class:  </th>
                <th style="border-bottom:1px solid #000;width:50%;"> 
                  &nbsp;&nbsp;&nbsp;&nbsp; '.$tc_all_data->tc_is_promoted_to_class.' &nbsp;&nbsp;&nbsp;&nbsp;  
                </th>
                <td>  </td>
              </tr>
            </table>
            <table style="width:100%;">
              <tr> 
                <th> If so to which class </th>
                <td style="text-align:left;">  
                   (in fig.) <span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_promoted_class.'</b></span>
                </td>
                <td style="text-align:left">
                  (in words) <span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_pramoted_class_in_word.'</b></span>
                </td>
              </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:55%;">13. Month up to which the (pupil has paid ) School dues paid:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_fees_paid_month.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:70%;">14. Any Fee concession available of :if so ,the nature of such concession:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_fees_concession.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:30%;">15. Total No of Working Days:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_working_days.' </b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:35%;">16. Total No of Working Days Present:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp; '.$tc_all_data->tc_working_days_present.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:65%;">17. Whether NCC Cadet / Boy Scout / Girl Guide (Details) May Be given :   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_ncc.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:70%;">18. Games played or extracurricular activities in which the pupil usually took part (mention achievment level there in):   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_extra_activity.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:20%;">19. General conduct :   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_general_conduct.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:37%;">20. Date of application for certificate:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_date_application.'</b></span></td>
            </tr>
            </table>

             <table style="width:100%;">
            <tr>
            <th style="width:30%;">21. Date of Issue for certificate:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_issue_date.'</b></span></td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:30%;">22. Reason for leaving the School:   </th>
            <td colspan="3" style="text-align:left">
              <span>
                <b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_reason_for_leaving_school.'</b>
              </span>
            </td>
            </tr>
            </table>

            <table style="width:100%;">
            <tr>
            <th style="width:30%;">23. Any Other remark:   </th>
            <td colspan="3" style="text-align:left"><span><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$tc_all_data->tc_remark.'</b></span></td>
            </tr>
            </table>

          
            </div>

          </div>';

          $html.='
         <table style="width:100%;margin-top:100px">
            <tr>
            <th style="width:25%; font-size:12px;border-top:1px solid grey">Signature of class Teacher   </th>
            <th></th>
            <th style="width:25%;font-size:12px;border-top:1px solid grey">Checked By With Full Name and Designation   </th>
            <th></th>
            <th style="width:25%;font-size:12px;border-top:1px solid grey">Principal Signature with Date and School Seal  </th>
            
            </tr>
            </table>
          ';
     

        // <img src="'.base_url('assets/images/School_Stamp_RM.png').'"style="width:70px;height:70px;">
        
        //$html = $html.$header.$body;
           $html= mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
                //echo $html; die;
         

        $paper_size = array(8.5, 11, 620, 920); 
        $dompdf->set_paper($paper_size);
        //$dompdf->set_paper('a4','portrait');
        $dompdf->load_html($html);
        $dompdf->render();
        $date = date("d-m-Y-H:i:s-A");
        ob_end_clean();
        // $dompdf->stream("Transfer_certificate".$date.".pdf");
        $dompdf->stream("Transfer_certificate".$date.".pdf", array("Attachment" =>false));
        // $pdf = $dompdf->output();
  }

  public function issue_multiple_tc(){
    // pre($_POST['favorite']); 
    $insert_id='';
    $ids=$_POST['favorite'];
    
    foreach ($ids as $key => $value) {
      $getstudent= $this->student_model->get_student_view_byid($value);
      // pre($getstudent,1);
      
      $insert_id=$this->tc_model->insert_tc_data($value);
    }
    if(isset($insert_id)){
      echo "success";
    }
    
  }

  function multiple_move_to_dropout(){ 
  	$ds_user_id=$_SESSION['super_logged_in']['SUPERADMIN_SESS_ID'];
    // pre($_POST,1);
    foreach ($_POST['student_ids'] as $key => $student_id) {
    	$student_info= $this->student_model->get_student_details_byid($student_id);

    	$ins_student=array(
    					'ds_student_id'=>$student_id,
    					'ds_detail_id'=>$student_info->details_pk_id,
    					'ds_admission_no'=>$student_info->student_school_admission_no,
    					'ds_class_id'=>$student_info->details_fk_class_id,
    					'ds_section_id'=>$student_info->details_fk_section_id,
    					'ds_user_id'=>$ds_user_id,
    					'ds_date'=>date('Y-m-d'),
    					);
	    
	    $res_ins=$this->student_model->insert_student_dropout($ins_student);
	    $res_upd=$this->student_model->update_student_dropout($student_id,$student_info->parent_pk_id,5,1);
	}

	echo "Success";
  }


  public function student_dropout_list(){
    $class_id = $this->uri->segment('3'); 
    $section_id = $this->uri->segment('4'); 

 	$class_list = $this->class_model->getClass();
 	$section_list = $this->Student_model->get_section_data($class_id);
    $dropout_list = $this->student_model->get_student_dropout_list();

    if($class_id!=''){
    	$dropout_list = $this->student_model->get_student_dropout_list($class_id,$section_id);
    }

    $sendData=array('dropout_list'=>$dropout_list,'class_list'=>$class_list,'section_list'=>$section_list,
    				'class_id'=>$class_id,'section_id'=>$section_id);
    self::slicing('student_dropout_list',$sendData);
  }

  function back_to_student_list(){
  	$student_pk_id=$_POST['student_pk_id'];
  	$student_info= $this->student_model->get_student_details_byid($student_pk_id);
  	// $res1=$this->student_model->update_student_dropout($student_pk_id,$student_info->parent_pk_id,1,0);

  	// if($_POST['the_type']==1){
  	// 	$res2=$this->student_model->delete_student_dropout($student_pk_id);
  	// }else if($_POST['the_type']==2){
   //    $upres=$this->student_model->update_back_student($student_pk_id);
  	// 	$res3=$this->student_model->delete_tc_student($student_pk_id);
  	// }
 
    //pre($tbl_wheres);
    //pre($tbl_wheresd,1);

    $res2=$this->student_model->delete_student_dropout($student_pk_id);
    // $res3=$this->student_model->delete_tc_student($student_pk_id);

    $tbl_wheres=array('student_pk_id'=>$student_pk_id);
    $tbl_up_datast=array('student_fk_status_id'=>1,'student_tc_allocation_status'=>NULL);

    $res4=$this->student_model->dynamic_data_update('sb_student',$tbl_up_datast,$tbl_wheres);

    $tbl_wheresd=array('details_fk_student_id'=>$student_pk_id);
    $tbl_up_datasd=array('details_fk_status_id'=>1);
    $res5=$this->student_model->dynamic_data_update('sb_student_details',$tbl_up_datasd,$tbl_wheresd);

    $tbl_wheresd1=array('tc_student_id'=>$student_pk_id);
    $tbl_up_datasd1=array('tc_generate_status'=>3);
    $res6=$this->student_model->dynamic_data_update('sb_transfar_certificate',$tbl_wheresd1,$tbl_up_datasd1);


  	echo "Success";
  }

  function numberTowords($num)
  {

    $ones = array(
    0 =>"ZERO",
    1 => "ONE",
    2 => "TWO",
    3 => "THREE",
    4 => "FOUR",
    5 => "FIVE",
    6 => "SIX",
    7 => "SEVEN",
    8 => "EIGHT",
    9 => "NINE",
    10 => "TEN",
    11 => "ELEVEN",
    12 => "TWELVE",
    13 => "THIRTEEN",
    14 => "FOURTEEN",
    15 => "FIFTEEN",
    16 => "SIXTEEN",
    17 => "SEVENTEEN",
    18 => "EIGHTEEN",
    19 => "NINETEEN",
    20 => "TWENTY",
    "014" => "FOURTEEN"
    );
    $tens = array( 
    0 => "ZERO",
    1 => "TEN",
    2 => "TWENTY",
    3 => "THIRTY", 
    4 => "FORTY", 
    5 => "FIFTY", 
    6 => "SIXTY", 
    7 => "SEVENTY", 
    8 => "EIGHTY", 
    9 => "NINETY" 
    ); 
    $hundreds = array( 
    "HUNDRED", 
    "THOUSAND", 
    "MILLION", 
    "BILLION", 
    "TRILLION", 
    "QUARDRILLION" 
    ); /*limit t quadrillion */
    $num = number_format($num,2,".",","); 
    $num_arr = explode(".",$num); 
    $wholenum = $num_arr[0]; 
    $decnum = $num_arr[1]; 
    $whole_arr = array_reverse(explode(",",$wholenum)); 
    krsort($whole_arr,1); 
    $rettxt = ""; 
    foreach($whole_arr as $key => $i){
      
    while(substr($i,0,1)=="0")
        $i=substr($i,1,5);
    if($i < 20){ 
    /* echo "getting:".$i; */
      $rettxt .=isset($ones[$i])?$ones[$i]:''; 
    }elseif($i < 100){ 
    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
    }else{ 
    if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
    if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
    if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
    $rettxt .= " ".$hundreds[$key]." "; 
    }
    } 
    if($decnum > 0){
    $rettxt .= " and ";
    if($decnum < 20){
    $rettxt .= $ones[$decnum];
    }elseif($decnum < 100){
    $rettxt .= $tens[substr($decnum,0,1)];
    $rettxt .= " ".$ones[substr($decnum,1,1)];
    }
    }
    return $rettxt;
  }

  function student_tc_req_list(){

    $sendData=array();
    self::slicing('student_tc_request_list',$sendData);
  }

    function get_student_tc_req_list(){

      $student_data=$this->tc_model->get_student_by_pk_id();

    // pre($student_data,1);
      $cnt = 1;
      $data1 = array();
      if(!empty($student_data)){

       foreach($student_data as $data) {  

          $tc_all_data=$this->tc_model->get_tc_data_by_id($data['student_id']);
          $move_tc='';
          if(count($tc_all_data)>0){
            $move_tc="<a href=".base_url()."tc_management/move_to_tc/".$data['student_id']." class='btn btn-success'>
                        Move To TC
                      </a>";
          }


          $status1 = 'Pending';
          $student_action = '';
          if($data['tc_generate_status'] == 2){
              $status1 = 'Send';
          }else{
             $student_action=" <a href=".base_url()."tc_management/tc_save_details/".$data['student_id']." class='btn btn-info'>
                  Prepare TC
                </a>";
          } 

          
          
          $data1[] = array(
            $cnt,
             $data['student_school_admission_no'],
             // $data['details_roll_number'],
             $data['class'].' - '.$data['section'],
             $data['student_name'],
             // $data['parent_father_name'],
             // $data['parent_mother_name'],
             // $data['student_dob'],
               $data['parent_guardian_contact'],
               $data['parent_guardian_email'],
               $data['remark'],
               $status1,
               $student_action.' &nbsp; '.$move_tc,
          );
          $cnt++;
        }
     }
      
      $output = array(
        "data" => $data1
      );
      echo json_encode($output);
      exit();


        }

    function tc_save_details(){
      IsAdminActive();
      $student_id = $this->uri->segment('3');
      $red = $this->uri->segment('4');
      $with_header = 'header';

       // pre( $with_header);
       // pre( $student_id,1);
      $isheader=false;
      if($with_header == 'header'){
        $isheader=true;
      }
      $getstudent= $this->student_model->get_student_view_byid($student_id);
      $stud_class_id = $getstudent->details_fk_class_id;
     // pre($stud_class_id,1);
      $tc_sr_no_auto_g = $this->tc_model->get_tc_sr_no();
      $tc_sr_no = $this->tc_model->get_tc_sr_no_by_stud_id($student_id);



      if(isset($tc_sr_no) && $tc_sr_no->tc_sr_no != ''){
          $sr_no = $tc_sr_no->tc_sr_no;
      }else{
         if($tc_sr_no_auto_g->tc_sr_no != 0){
         $sr_no = $tc_sr_no_auto_g->tc_sr_no+1;
      }else{
         $sr_no = 1;
      }
      }
     // pre($tc_sr_no);
     // pre($sr_no,1);
     

      $tc_all_data=$this->tc_model->get_tc_data_by_id($student_id);

      $srno=isset($tc_all_data->tc_srno)?$tc_all_data->tc_srno:'';
      // pre($tc_all_data,1);

      if(empty($getstudent)){
         redirect(base_url().'student', 'refresh');
      }
      $school_data= $this->school_model->getSchool($getstudent->parent_fk_school_id);
      $pstData = array('student_id'=>$getstudent->details_pk_id,'class'=>$getstudent->details_fk_class_id,'section_id'=>$getstudent->details_fk_section_id);
      $getExamMrks = $this->class_model->get_report_exam_marks($pstData);
      $max = -999999;
      $exam_name= '';
      $Markslist = array();
      $passSts=$grade='';
      $subject_list = '';
      if(count($getExamMrks)>0){
        foreach($getExamMrks as $k=>$v)
          {
            if(strtotime($v[0]['marks_added_date'])>$max)
            {
               $max = strtotime($v[0]['marks_added_date']);
               $Markslist[] = $v;
               $ex = $this->exam_model->getExamName($k);
               $exam_name = $ex->exam_name;
            }
          }
          $total_max_marks = $total_passing_marks = $total_obtained_marks = 0;
          $i = 1;
          foreach($Markslist[0] as $mrKey => $mrVal){
            $total_max_marks = $total_max_marks+$mrVal['schedule_out_of_marks'];
            $total_passing_marks = $total_passing_marks + $mrVal['schedule_passing_marks'];
            $total_obtained_marks = $total_obtained_marks + $mrVal['marks_marks'];
            $subject_list .= $i.". ".preg_replace('/\d+/u', '', $mrVal['sub_main_name'])." ";
            $i++;
          }
          $rndMrk = round($total_obtained_marks);

          $rndMrk1=0;
          if($total_max_marks!=0){
            $rndMrk1 = round(($total_obtained_marks/$total_max_marks)*100);
          }
 
          $where3 = "$rndMrk1 BETWEEN grade_min_marks AND grade_max_marks";
          $this->db->select('grade_name');
          $getSqlRes = $this->db->get_where('grade',$where3);
          $gradeResult = $getSqlRes->row();
          $grade = isset($gradeResult->grade_name)?$gradeResult->grade_name:'';
          // pre($gradeResult,1);

          if($rndMrk<=$total_max_marks && $rndMrk>=$total_passing_marks)
          {
            $passSts = 'Pass with '.$grade.' Grade';
          } else {
            $passSts = 'Fail';
          }
        
      }
      
      $sof = (strtolower($getstudent->student_gender) == 'male')?'S/o':'D/o';
      $hisher = (strtolower($getstudent->student_gender) == 'male')?'his':'her';
      $heshe = (strtolower($getstudent->student_gender) == 'male')?'He':'She';
      $mamis = (strtolower($getstudent->student_gender) == 'male')?'Master':'Miss';
      $classes_word = array( 
        1 => "First", 
        2 => "Second", 
        3 => "Third", 
        4 => "Fourth", 
        5 => "Fifth", 
        6 => "Sixth", 
        7 => "Seventh", 
        8 => "Eighth", 
        9 => "Ninth", 
        10 => "Tenth", 
        11 => "Eleventh", 
        12 => "Twelvth"
      ); 
      $tc_dob='';

      if($this->input->post()){
        $student_id=$getstudent->student_pk_id;
         $tc_ins_data= array(  
                 'tc_student_id' =>$student_id,  
                 'tc_aadhar_card' =>$_POST['tc_aadhar_card'],  
                 // 'tc_aadhar_card_mother' =>$_POST['tc_aadhar_card_mother'],  
                 // 'tc_aadhar_card_father' =>$_POST['tc_aadhar_card_father'],  
                 'tc_nationality' =>$_POST['tc_nationality'],  
                 'tc_whether_failed' =>$_POST['tc_whether_failed'],  
                 'tc_subjects' =>$_POST['tc_subjects'],  
                 'last_class_in_word' =>$_POST['last_class_in_word'],  
                 'tc_last_taken_result' =>$_POST['tc_last_taken_result'],  
                 'tc_promoted_class' =>$_POST['tc_promoted_class'],  
                 'tc_fees_paid_month' =>$_POST['tc_fees_paid_month'],  
                 'tc_fees_concession' =>$_POST['tc_fees_concession'],  
                 'tc_ncc' =>$_POST['tc_ncc'],  
                 'tc_date_rolls' =>($_POST['tc_date_rolls']!='')?date("Y-m-d",strtotime($_POST['tc_date_rolls'])):NULL,  
                 'tc_reason_for_leaving_school' =>$_POST['tc_reason_for_leaving_school'],  
                 'tc_no_meetings' =>$_POST['tc_no_meetings'],  
                 'tc_general_conduct' =>$_POST['tc_general_conduct'],  
                 'tc_remark' =>$_POST['tc_remark'],  
                 'tc_issue_date' =>($_POST['tc_issue_date']!='')?date("Y-m-d",strtotime($_POST['tc_issue_date'])):NULL,  
                 'tc_student_category' =>$_POST['student_category'],  
                 'tc_generate_status' =>1,
                 'tc_reg_no_class_9_to_12' =>$_POST['tc_reg_no_class_9_to_12'],  
                 'tc_sr_no' =>$_POST['sr_no'],
                 'tc_proof_of_date'=>$_POST['tc_proof_of_date'],
                 'tc_date_first_admission'=>($_POST['tc_date_first_admission']!='')?date("Y-m-d",strtotime($_POST['tc_date_first_admission'])):NULL,
                 'tc_date_first_admission_class'=>$_POST['tc_date_first_admission_class'],
                 'tc_extra_activity'=>$_POST['tc_extra_activity'],
                 'tc_date_application'=>($_POST['tc_date_application']!='')?date("Y-m-d",strtotime($_POST['tc_date_application'])):NULL,  
               ); 

          if(count($tc_all_data)==0){
            $this->tc_model->dynamic_data_insert('sb_transfar_certificate',$tc_ins_data);
          }else{
            $thewhere=array('tc_student_id'=>$student_id);
            $this->tc_model->dynamic_data_update('sb_transfar_certificate',$tc_ins_data,$thewhere);
          }

          
          return $this->_flashdatacheck($success=1,"Successfully Saved","Thanks you!","tc_management/student_tc_req_list");
      } 

      $sendData = array(
            'getstudent'=>$getstudent,
            'school_data'=>$school_data[0],
            'exam_name'=>$exam_name,
            'result'=>$passSts,
            'subject_list'=>$subject_list,
            'classes_word'=>$classes_word,
             'move_to_tc'=>1 ,
             'tc_all_data'=>$tc_all_data,
             'srno'=>$srno,
             'sr_no'=>$sr_no,
             'tc_dob'=>$tc_dob,
             'stud_class_id'=>$stud_class_id,
             'is_send_email'=>0,
          );

      self::slicing('download_transfer_certificates',$sendData);
    }    

  function tc_taken_list_excel(){
    require_once(APPPATH.'libraries/Excel-uploader-downloader-php/PHPExcel/IOFactory.php');

    $class_id =$this->uri->segment('3');
    $section_id = $this->uri->segment('4');

    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
              'color'=>array('rgb','255,0,0')
              
          )
      )

    );

    $style = array(
      'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      )
    );

    $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");

    $objPHPExcel->setActiveSheetIndex(0); 

    $fixcnt=1;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$fixcnt, 'Srno');
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$fixcnt, 'Tc Srno');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$fixcnt, 'Admission No');
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$fixcnt, 'Registration no. of the Candidate (in case of Class-IX to XII)');
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$fixcnt, 'Student Name');
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$fixcnt, 'Aadhar Card');
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$fixcnt, 'Nationality');
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$fixcnt, 'Whether the student belongs to SC/ST/OBC Category');
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$fixcnt, 'Proof of Date of Birth submitted at the time of admission');
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$fixcnt, 'Date of first admission in the School with class');
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$fixcnt, 'class');
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$fixcnt, 'Class in which the student last studied (in words)');
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$fixcnt, 'School/Board Annual examination last taken with result');
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$fixcnt, 'Whether failed, if so once/twice in the same class');
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$fixcnt, 'Subjects offered');
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$fixcnt, 'Whether qualified for promotion to the next higher class');
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fixcnt, 'Whether the student has paid all dues to the School');
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$fixcnt, 'Whether the student was in receipt of any fee concession, if so the nature of such concession');
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$fixcnt, 'Whether the student is NCC Cadet / Boy Scout / Girl Guide (give details)');
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$fixcnt, 'Games played or extracurricular activities in which the student usually took part (mention the level upto which played)');
    $objPHPExcel->getActiveSheet()->setCellValue('U'.$fixcnt, 'Date of application for certificate');
    $objPHPExcel->getActiveSheet()->setCellValue('V'.$fixcnt, 'Date on which student\'s name was struck off the rolls of the School');
    $objPHPExcel->getActiveSheet()->setCellValue('W'.$fixcnt, 'Reason for leaving the School');
    $objPHPExcel->getActiveSheet()->setCellValue('X'.$fixcnt, 'Total No. of presence in the academic session');
    $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fixcnt, 'General conduct');
    $objPHPExcel->getActiveSheet()->setCellValue('Z'.$fixcnt, 'Any other remarks');
    $objPHPExcel->getActiveSheet()->setCellValue('AA'.$fixcnt, 'Date of issue of Certificate');

    $tc_taken_list = $this->tc_model->get_tc_taken_data_list($class_id,$section_id);

    // pre($tc_taken_list,1);
    $srno=1;
    $rowcnt=2;
    foreach ($tc_taken_list as $key => $tc_value) {
      $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowcnt, $srno);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowcnt, $tc_value->tc_sr_no);
      $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowcnt, $tc_value->student_school_admission_no);
      $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowcnt, $tc_value->tc_reg_no_class_9_to_12);
      $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowcnt, $tc_value->student_name);
      $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowcnt, $tc_value->tc_aadhar_card);
      $objPHPExcel->getActiveSheet()->setCellValue('G'.$rowcnt, $tc_value->tc_nationality);
      $objPHPExcel->getActiveSheet()->setCellValue('H'.$rowcnt, $tc_value->tc_student_category);
      $objPHPExcel->getActiveSheet()->setCellValue('I'.$rowcnt, $tc_value->tc_proof_of_date);
      $objPHPExcel->getActiveSheet()->setCellValue('J'.$rowcnt, $tc_value->tc_date_first_admission);
      $objPHPExcel->getActiveSheet()->setCellValue('K'.$rowcnt, $tc_value->tc_date_first_admission_class);
      $objPHPExcel->getActiveSheet()->setCellValue('L'.$rowcnt, $tc_value->last_class_in_word);
      $objPHPExcel->getActiveSheet()->setCellValue('M'.$rowcnt, $tc_value->tc_last_taken_result);
      $objPHPExcel->getActiveSheet()->setCellValue('N'.$rowcnt, $tc_value->tc_whether_failed);
      $objPHPExcel->getActiveSheet()->setCellValue('O'.$rowcnt, $tc_value->tc_subjects);
      $objPHPExcel->getActiveSheet()->setCellValue('P'.$rowcnt, $tc_value->tc_promoted_class);
      $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowcnt, $tc_value->tc_fees_paid_month);
      $objPHPExcel->getActiveSheet()->setCellValue('R'.$rowcnt, $tc_value->tc_fees_concession);
      $objPHPExcel->getActiveSheet()->setCellValue('S'.$rowcnt, $tc_value->tc_ncc);
      $objPHPExcel->getActiveSheet()->setCellValue('T'.$rowcnt, $tc_value->tc_extra_activity);
      $objPHPExcel->getActiveSheet()->setCellValue('U'.$rowcnt, $tc_value->tc_date_application);
      $objPHPExcel->getActiveSheet()->setCellValue('V'.$rowcnt, $tc_value->tc_date_rolls);
      $objPHPExcel->getActiveSheet()->setCellValue('W'.$rowcnt, $tc_value->tc_reason_for_leaving_school);
      $objPHPExcel->getActiveSheet()->setCellValue('X'.$rowcnt, $tc_value->tc_no_meetings);
      $objPHPExcel->getActiveSheet()->setCellValue('Y'.$rowcnt, $tc_value->tc_general_conduct);
      $objPHPExcel->getActiveSheet()->setCellValue('Z'.$rowcnt, $tc_value->tc_remark);
      $objPHPExcel->getActiveSheet()->setCellValue('AA'.$rowcnt, $tc_value->tc_issue_date);

      $rowcnt++;
      $srno++;
    }

    $fileName='tc_taken_lists'.date('ymdhis');
    $objPHPExcel->getActiveSheet()->setTitle($fileName);

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');  
    exit(); 
  } 

  function slicing($viewTemp,$sendArray) {
    $this->load->view('superadmin/master/header');
    $this->load->view('superadmin/'.$viewTemp,$sendArray);
    $this->load->view('superadmin/master/left');
    $this->load->view('superadmin/master/footer');
  }

  private function _flashdatacheck($successfull, $successMessage, $failureMessage, $redirectTo)
  {
    if($successfull)
    {
          $this->session->set_flashdata('feedback',$successMessage);
        $this->session->set_flashdata('feedback_Class',"alert-success");
    }
    else
    {
          $this->session->set_flashdata('feedback',$failureMessage);
        $this->session->set_flashdata('feedback_Class',"alert-danger");
    }
    return redirect($redirectTo);
  }


  public function attendance_cal_by_stud_id($student_pk_id='')
  {
      $year_start_date=1;
       $start_month=1;
       $sess=explode('-',get_current_edu_session());
       $year=$sess[0];
      $prev_end_month=1;
       
      $last_date_of_current_month=0;
      $total_sunday_before_sel_curr_month=0;
      $total_day_before_sel_curr_month=0;
      $dateDiff1=0;
      $tot_cnt_p1=0;
      $c_date=$year."-".$start_month."-".$year_start_date;
      $last_date_of_current_month=date("t",strtotime($c_date));
      for($j=$start_month;$j<=12;$j++)
      {
        $c_date=$year."-".$j."-".$year_start_date;
        $last_date_of_current_month=date("t",strtotime($c_date));
        for($i=$year_start_date;$i<=$last_date_of_current_month;$i++)
        {
          $total_day_before_sel_curr_month++;
          //echo date("d-m-Y",strtotime($year."-".$j."-".$i));
          $cal_date4=date("Y-m-d",strtotime($year."-".$j."-".$i));
          if(date("N",strtotime($year."-".$j."-".$i))==7)
          {
            $total_sunday_before_sel_curr_month++;

            $get_holiday_list1=$this->attendance_manage_model->get_holiday_list_by_date($cal_date4);
            if(!empty($get_holiday_list1)){

              if($get_holiday_list1[0]->holiday_app_classes != 'all'){
                $cls = explode(',', $get_holiday_list1[0]->holiday_app_classes);
                if(in_array($class_id, $cls)){
                  $dateDiff1 = $this->dateDiff($get_holiday_list1[0]->holiday_start_date, $get_holiday_list1[0]->holiday_end_date);
                   $dateDiff1 += 1; 
                }
              }else{
                $dateDiff = $this->dateDiff($get_holiday_list1[0]->holiday_start_date, $get_holiday_list1[0]->holiday_end_date);
                   $dateDiff1 += 1; 
              }
            }

          }

          //Attendance count start
          $whereats=array('ams_student_id'=>$student_pk_id,'ams_attendance_date'=>$cal_date4); 
            $attendance_list1=$this->attendance_manage_model->get_attendance_datewise_list_by_id_new($whereats);
          if(!empty($attendance_list1)){
          
            $attr_status = array();
            foreach ($attendance_list1 as $key => $value) 
            {
              
              if(isset($attr_status[$value['ams_attendance_status']])){
              $attr_status[$value['ams_attendance_status']] = $attr_status[$value['ams_attendance_status']]+1;  
              }else{
                $attr_status[$value['ams_attendance_status']] = $value['ams_attendance_status'];  
              }
   
            }
   
              $ams_attendance_status = $value['ams_attendance_status'] ;  
   
              $present = (isset($attr_status[1]))?$attr_status[1]:0;
              $pp = (isset($attr_status[2]))?$attr_status[2]:0;
              $absent = (isset($attr_status[3]))?$attr_status[3]:0;
               $attendance_type = $attendance_list1[0]['ams_attendance_type'];
   
               if($attendance_type == 1){
                   if($present != 0 ){
                    $tot_cnt_p1 += 1;
                  }
               }else{
   
               
   
                  if($no_of_lecture == ''){
   
                    if($present >= 1){
                      $tot_cnt_p1 += 1;
                    }
                  }else{
   
                    if($present >= $no_of_lecture){
                      $tot_cnt_p1 += 1;
                    }
   
                  }
   
                  
               }
   
          }

          //Attendance count end

          
        }

      }
      $total_working_day_before_sel_month=$total_day_before_sel_curr_month-($dateDiff1+$total_sunday_before_sel_curr_month);
      
      return array('present'=>$tot_cnt_p1,'total_day'=>$total_working_day_before_sel_month);
  }

    function dateDiff($date1, $date2)
{

    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
}

function total_sun($month,$year)
{
    $sundays=0;
    $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for($i=1;$i<=$total_days;$i++)
    if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
    $sundays++;
    return $sundays;
}
}
?>
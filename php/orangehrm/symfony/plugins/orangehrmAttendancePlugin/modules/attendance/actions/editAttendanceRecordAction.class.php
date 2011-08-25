<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class editAttendanceRecordAction extends sfAction {

    public function execute($request) {

        $this->editPunchIn = array();
        $this->editPunchOut = array();
        $this->employeeId = $request->getParameter('employeeId');
        $this->messageData =array($request->getParameter('message[0]'), $request->getParameter('message[1]'));
 
        $this->date = $request->getParameter('date');

        $this->actionRecorder = $request->getParameter('actionRecorder');
        $userObj = sfContext::getInstance()->getUser()->getAttribute('user');
        $userId = $userObj->getUserId();
        $userEmployeeNumber = $userObj->getEmployeeNumber();
        $this->records = $this->getAttendanceService()->getAttendanceRecord($this->employeeId, $this->date);
        $totalRows = sizeOf($this->records);

        $values = array('employeeId' => $this->employeeId, 'date' => $this->date);
        $this->editAttendanceForm = new EditAttendanceRecordForm(array(), $values);
        $formSubmitAction = $request->getParameter('formSubmitAction');


        if ($this->actionRecorder == "viewEmployee") {
            $userRoleFactory = new UserRoleFactory();
            $decoratedUser = $userRoleFactory->decorateUserRole($userId, $this->employeeId, $userEmployeeNumber);
        }
        if ($this->actionRecorder == "viewMy") {

            $user = new User();
            $decoratedUser = new EssUserRoleDecorator($user);
        }



        $i = 1;
        foreach ($this->records as $record) {


            $allowedActionsForCurrentRecord = $decoratedUser->getAllowedActions(WorkflowStateMachine::FLOW_ATTENDANCE, $record->getState());

            if (in_array(WorkflowStateMachine::ATTENDANCE_ACTION_EDIT_PUNCH_IN_TIME, $allowedActionsForCurrentRecord)) {

                $this->editPunchIn[$i] = true;
            } else {
                $this->editPunchIn[$i] = false;
            }

            if (in_array(WorkflowStateMachine::ATTENDANCE_ACTION_EDIT_PUNCH_OUT_TIME, $allowedActionsForCurrentRecord)) {

                $this->editPunchOut[$i] = true;
            } else {
                $this->editPunchOut[$i] = false;
            }
            $i++;
        }

       
        if ($formSubmitAction) {
            if ($request->isMethod('post')) {
         
                $this->editAttendanceForm->bind($request->getParameter('attendance'));
 
                if ($this->editAttendanceForm->isValid()) {
              
                    $this->editAttendanceForm->save($totalRows, $this->editAttendanceForm);
                     $messageData = array('SUCCESS', __(' Records Saved Successfully'));
                      $this->redirect('attendance/editAttendanceRecord' . '?' . http_build_query(array('message' => $messageData, 'actionRecorder' => $this->actionRecorder, 'employeeId' => $this->employeeId,'date' =>$this->date)));
                }
            }
        }
    }

    public function getAttendanceService() {

        if (is_null($this->attendanceService)) {
            $this->attendanceService = new AttendanceService();
        }

        return $this->attendanceService;
    }

    public function setTimesheetDao(AttendanceService $attendanceService) {

        $this->attendanceService = $attendanceService;
    }

}
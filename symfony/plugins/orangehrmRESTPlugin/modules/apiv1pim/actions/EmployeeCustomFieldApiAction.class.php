<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */

use Orangehrm\Rest\Http\Request;
use Orangehrm\Rest\Api\Pim\EmployeeCustomFieldAPI;

class EmployeeCustomFieldApiAction extends baseRestAction
{
    private $apiEmployeeCustomField = null;

    protected function init(Request $request)
    {
        $this->apiEmployeeCustomField = new EmployeeCustomFieldAPI($request);
    }

    protected function handleGetRequest(Request $request)
    {
        return $this->apiEmployeeCustomField->getCustomFields();
    }

    protected function handlePostRequest(Request $request)
    {
        return $this->apiEmployeeCustomField->saveEmployeeCustomField();
    }

    protected function handlePutRequest(Request $request)
    {
        return $this->apiEmployeeCustomField->saveEmployeeCustomField();
    }
    protected function handleDeleteRequest(Request $request)
    {
        return $this->apiEmployeeCustomField->deleteEmployeeCustomField();
    }

    /**
     * @return null
     */
    public function getApiEmployeeCustomField()
    {
        return $this->apiEmployeeCustomField;
    }

    /**
     * @param null $apiEmployeeCustomField
     */
    public function setApiEmployeeCustomField($apiEmployeeCustomField)
    {
        $this->apiEmployeeCustomField = $apiEmployeeCustomField;
    }



}


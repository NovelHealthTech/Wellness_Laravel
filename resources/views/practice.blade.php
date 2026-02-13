<?php

  if ($data['wellness']->id == 2) 
  {
            /***************************** Mfine Consultation API Integrations ***********************/
            $consultation_body = '{
                "user_type": "patient",
                "target_url": "https://www.mfine.co/channel/zoom-gen",
                "user_details": {
                    "mobile_number": "91' . $data['employee']->mobile . '",
                    "firstname": "' . $data['employee']->full_name . '",
                    "lastname": " ",
                    "email": "' . $data['employee']->email . '"
                }
            }';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mfine.co/api/v1/silent-login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $consultation_body,
                CURLOPT_HTTPHEADER => array
                (
                    'client_id: zoom-gen',
                    'secret_key: g5GcWM2275MHo2FY7b4wQiJof7EEw2MXJwaiMp5NijaLlvEevPmEyJe5j0St9KQW',
                    'Content-Type: application/json'
                ),
            ));

            $response_consultation = curl_exec($curl);

            curl_close($curl);

            $data['consultations'] = json_decode($response_consultation)->redirect_url;

            $apilog = array(
                'mfine_service' => 'consultation',
                'request' => $consultation_body,
                'response' => $response_consultation
            );

            $this->logfile_model->writeToLog($apilog, 'Api Logs', 'mfine_logs');

            /***************************** Mfine Consultation API Integrations ***********************/


            /***************************** Subcribe Consultation API Integrations ***********************/
            $subscribe_consultation_body = '{
                "plan_id": "621e16cea446355e66b78535",
                "mobile_number": "91' . $data['employee']->mobile . '"
            }';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mfine.co/api/v1/subscriptions/subscribe',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $subscribe_consultation_body,
                CURLOPT_HTTPHEADER => array(
                    'client_id: zoom-gen',
                    'secret_key: g5GcWM2275MHo2FY7b4wQiJof7EEw2MXJwaiMp5NijaLlvEevPmEyJe5j0St9KQW',
                    'Content-Type: application/json'
                ),
            ));

            $response_subscribe_consultation = curl_exec($curl);

            curl_close($curl);

            $apilog = array(
                'mfine_service' => 'consultation',
                'request' => $subscribe_consultation_body,
                'response' => $response_subscribe_consultation
            );

            $this->logfile_model->writeToLog($apilog, 'Api Logs', 'mfine_logs');
            /***************************** Subcribe Consultation API Integrations ***********************/

            redirect($data['consultations']);

        }

        if ($data['wellness']->id == 3) 
        {
            /***************************** Covid Care API Integrations ***********************/
            $covid_care_body = '{
                    "user_type": "patient",
                    "target_url": "https://www.mfine.co/channel/zoom-gen-cc",
                    "user_details": {
                        "mobile_number": "91' . $data['employee']->mobile . '",
                        "firstname": "' . $data['employee']->full_name . '",
                        "lastname": " ",
                        "email": "' . $data['employee']->email . '"
                    }
                }';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mfine.co/api/v1/silent-login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $covid_care_body,
                CURLOPT_HTTPHEADER => array(
                    'client_id: zoom-gen-cc',
                    'secret_key: vIw5bmYbamMMEBG2NKbVrntPTWy0EfcjctSiUa9wY1CHAa58ZSZ8H2FGaHkjHsIb',
                    'Content-Type: application/json'
                ),
            ));

            $response_covid_care = curl_exec($curl);

            curl_close($curl);

            $data['consultations'] = json_decode($response_covid_care)->redirect_url;

            $covid_care_body_apilog = array(
                'mfine_service' => 'covid_care',
                'request' => $covid_care_body,
                'response' => $response_covid_care
            );

            $this->logfile_model->writeToLog($covid_care_body_apilog, 'Api Logs', 'mfine_logs');

            redirect($data['consultations']);
        }

        if ($data['wellness']->id == 4) 
        {

            /***************************** Health Check API Integrations ***********************/
            $health_check_body = '{
                "user_type": "patient",
                "target_url": "https://www.mfine.co/channel/zoom-gen-ha",
                "user_details": {
                    "mobile_number": "91' . $data['employee']->mobile . '",
                    "firstname": "' . $data['employee']->full_name . '",
                    "lastname": " ",
                    "email": "' . $data['employee']->email . '"
                }
            }';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mfine.co/api/v1/silent-login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $health_check_body,
                CURLOPT_HTTPHEADER => array(
                    'client_id: zoom-gen-ha',
                    'secret_key: G3bD4BSX5pKZDhMqO2SNTbNKzOwR1Y3rV8P1CDM5cVjBJlLDGHldCaWgpwCwA1K0',
                    'Content-Type: application/json'
                ),
            ));

            $response_health_check = curl_exec($curl);

            curl_close($curl);

            $data['consultations'] = json_decode($response_health_check)->redirect_url;

            $health_check_apilog = array(
                'mfine_service' => 'health_check',
                'request' => $health_check_body,
                'response' => $response_health_check
            );

            $this->logfile_model->writeToLog($health_check_apilog, 'Api Logs', 'mfine_logs');
            /***************************** Health Check API Integrations ***********************/

            /***************************** Subcribe Health Checks API Integrations ***********************/
            $subscribe_health_check_body = '{
                "plan_id": "621e16c2a446355e66b78534",
                "mobile_number": "91' . $data['employee']->mobile . '"
            }';

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => 'https://api.mfine.co/api/v1/subscriptions/subscribe',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $subscribe_health_check_body,
                CURLOPT_HTTPHEADER => array(
                    'client_id: zoom-gen-ha',
                    'secret_key: G3bD4BSX5pKZDhMqO2SNTbNKzOwR1Y3rV8P1CDM5cVjBJlLDGHldCaWgpwCwA1K0',
                    'Content-Type: application/json'
                ),              
            ));

            $response_subscribe_health_check = curl_exec($curl);

            curl_close($curl);

            $apilog = array(
                'mfine_service' => 'consultation',
                'request' => $subscribe_health_check_body,
                'response' => $response_subscribe_health_check
            );

            $this->logfile_model->writeToLog($apilog, 'Api Logs', 'mfine_logs');

            redirect($data['consultations']);
        }

        if ($data['wellness']->id == 5) {

            /***************************** E-Pharmacy API Integrations ***********************/

            $data = 
            [
                "number" => $data['employee']->mobile,
                "merchant_key" => "a46ed817-ecb5-4f8d-80d1-4d73ad37e044",
                "user_id" => "1",
                "source" => "novelhealthtech",
                "redirect_url" => "https://www.1mg.com"
            ];

            $jsonData = json_encode($data);

            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.1mg.com/api/v6/b2b/generate_hash',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_HTTPHEADER => array(
                    'X-Access-key: 1mg_client_access_key',
                    'Content-Type: application/json'
                ),
            ));
            
            $response = curl_exec($curl);

            curl_close($curl);

            // $apilog = array(
            //     'wellness_service' => 'E-Pharmacy',
            //     'request' => $jsonData,
            //     'response' => $response
            // );

            // p($apilog);

          
            $response_data = json_decode($response);

            // p($response_data);

            // p($response_data->data->hash);

            if($response_data->is_success == 1) 
            {
                $data['consultations'] = 'https://www.1mg.com?merchant_token=' . $response_data->data->hash . '&number=' . $data['employee']->mobile;

            } 
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong while generating E-Pharmacy link. Please try again later.');
                redirect(comp_url() . 'employee-dashboard');

            }

            redirect($data['consultations']);
            /***************************** E-Pharmacy API Integrations ***********************/
        }

        if ($data['wellness']->id == 6) 
        {
            /***************************** Self Checks API Integrations ***********************/
            $self_checks_body = '{
                "user_type": "patient",
                "target_url": "https://www.mfine.co/channel/zoom-gen-sc",
                "user_details": {
                    "mobile_number": "91' . $data['employee']->mobile . '",
                    "firstname": "' . $data['employee']->full_name . '",
                    "lastname": " ",
                    "email": "' . $data['employee']->email . '"
                }
            }';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mfine.co/api/v1/silent-login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $self_checks_body,
                CURLOPT_HTTPHEADER => array(
                    'client_id: zoom-gen-sc',
                    'secret_key: Y8NzQcDvm9HIfFqc3CjQGCOQaTOHrn3aDWPxNDZr4Tbk0OL0zKk0iOmACwRx8Nfk',
                    'Content-Type: application/json'
                ),
            ));

            $response_self_checks = curl_exec($curl);

            curl_close($curl);

            $data['consultations'] = json_decode($response_self_checks)->redirect_url;

            $self_checks_body_apilog = array(
                'mfine_service' => 'self_checks',
                'request' => $self_checks_body,
                'response' => $response_self_checks
            );

            $this->logfile_model->writeToLog($self_checks_body_apilog, 'Api Logs', 'mfine_logs');

            redirect($data['consultations']);
            /***************************** Self Checks API Integrations ***********************/
        }

        if ($this->is_in_waiting_area == 1) {

            $this->load->view('employee_views/partials/_header_first_enroll', $data);
        } 
        else 
        {
            $this->load->view('employee_views/partials/_header', $data);

        }

        $this->load->view('wellness_pages/' . $data['wellness']->page_link, $data);
        $this->load->view('employee_views/partials/_footers/footer_3', $data);
<?php



namespace App\Controllers;

use App\Models\userModel;

class loginController extends BaseController
{
    public $session;
    public $db;
    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
    }
    public function login()
    {
        $userModel = new userModel();
        $session = session();
        // if ($session->get('username')) {
        //     return redirect()->to('/');
        // }
        if ($this->request->getMethod() == "post") {
            $email = $this->request->getVar()['email'];
            $password = $this->request->getVar()['password'];
            $result = $userModel->where('email', $email)->where('password', md5($password))->findAll();
            if (count($result) > 0) {
                $session->set("username", $result[0]['f_name']);
                $session->set("user_id", $result[0]['id']);
                return redirect()->to("/");
            } else {
                $session->setFlashdata("error", "<strong>Invalid Credentials!</strong> Please Check Your Email & Password.");
                return view('login');
            }
        } else {
            return view('login');
        }
    }
    // Logout Function 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }


    // Signup function
    public function signup()
    {
        $userModel = new userModel();
        $session = session();
        $fname = $this->request->getVar()['fname'];
        $lname = $this->request->getVar()['lname'];
        $referedby = $this->request->getVar()['referedby'];
        $pancard = $this->request->getVar()['pancard'];
        $email = $this->request->getVar()['email'];
        $password = md5($this->request->getVar()['password']);
        $isValid = [
            'fname' => 'required',
            'lname' => 'required',
            'referedby' => 'required|exact_length[10]|is_not_unique[userlogin.referralid]',
            'pancard' => 'required|exact_length[10]',
            'email' => 'required|valid_email|is_unique[userlogin.email]',
            'password' => 'required'
        ];
        if ($this->validate($isValid)) {
            $referedby = $userModel->where('referralid', $referedby)->find();
            $refereddby = $referedby[0]['id'];
            echo $refereddby;
            // exit;
            $referralid = "DARW" . rand(100000, 999999);
            $data = [
                "f_name" => $fname,
                "l_name" => $lname,
                'referedby' => $refereddby,
                "pancard" => $pancard,
                "email" => $email,
                "password" => $password,
                'referralid' => $referralid
            ];
            if ($userModel->insert($data)) {
                $session->setFlashdata("success", "<strong>Successfully Registered!</strong> Please Login to authenticate.");
                return redirect()->to('/login');
            } else {
                $session->setFlashdata("error", "Registration Failed");
                return redirect()->to('/login');
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function homepage()
    {
        $isvalid = ['id' => 'is_not_unique[userlogin.id]|integer'];

        if ($this->session->get('user_id')) {
            if ($this->session->get('user_id')) {
                $id = $this->session->get('user_id');
                $userController = new loginController();
                // $indi = $userController->getindirect($id);
                // echo "<pre>";
                $level = ($userController->getlevelcountByid($id));

                // print_r($userController->getDirectCommission($level[1]['level']));
                // exit;
                // exit;
                $tree = ($userController->generateTree($id));
                // exit;


                // to get direct referral 
                $res = $this->db->query("select count(*) from userlogin where referedby=" . $id)->getResultArray();
                // print_r($res[0]['count(*)']);exit;
                $directreferral = $res[0]['count(*)'];
                //  

                // to get all referrals.
                $res = $this->db->query("WITH RECURSIVE referrals AS ( SELECT id, referedby FROM userlogin WHERE id = " . $id . " UNION ALL SELECT u.id, u.referedby FROM userlogin u INNER JOIN userlogin r ON u.referedby = r.id ) SELECT * FROM referrals where id>" . $id . ";")->getResultArray();
                $indirect = $this->db->query("WITH RECURSIVE subchilds AS (
                    SELECT id, referedby, email FROM userlogin WHERE id = $id
                    UNION ALL
                    SELECT u.id, u.referedby, u.email FROM userlogin u
                    JOIN subchilds s ON u.referedby = s.id
                    WHERE u.id !=$id AND u.referedby != s.referedby
                )
                SELECT COUNT(*) AS TOTAL FROM subchilds where id!= $id AND referedby !=$id;")->getResultArray();
                //  print_r($indirect);exit;
                $allreferral = count($res);
                // echo "total " . $allreferral;
                // print_r($res);
                // exit;
                return view('homepage', ['totalreferral' => ($directreferral + $indirect[0]['TOTAL']), 'indirectreferral' => ($indirect[0]['TOTAL']), 'directreferral' => $directreferral, 'tree' => $tree, 'id' => $id, 'level' => $level]);
            } else {
                echo "<div class='text-danger'><b><h2>Wrong ID</h2></b></div>";
                return redirect()->to('login');
            }
        } else {
            return redirect()->to('login');
        }
    }

    function generateTree($parentId)
    {

        $result = $this->db->query("SELECT id, f_name, l_name,referralid, email FROM userlogin WHERE referedby = $parentId")->getResultArray();

        // If there are no children, return an empty string
        if (count($result) == 0) {
            return '';
        }

        // Otherwise, start a new nested list
        $output = '<ul class="tree vertical ">';
        $userController = new loginController();
        // Loop through the children and add each one to the list
        foreach ($result as $row) {
            // print_r($row);
            // echo "<br>";
            $output .= '<li><div class="content"><b>' . $row['id'] . ' </b></div>       ';
            $output .= $userController->generateTree($row['id']);
            $output .= '</li>';
            // $this->i++;
        }

        // Close the nested list
        $output .= '</ul>';

        // Return the generated HTML
        return $output;
    }

    function DirectReferral()
    {
        $id = $this->session->get("user_id");
        $userModel = new userModel();
        $result = $userModel->where('referedby', $id)->findAll();
        return view('DirectReferrals', ['directreferral' => $result]);
    }
    function ReferralHierarchy()
    {
        if ($this->session->get('user_id')) {
            $id = $this->session->get('user_id');
            $loginController = new loginController();
            // echo  number_format($loginController->getCommision(12200), 2);
            // exit;
            $hierarchy = $loginController->generateTree($id);

            return view('ReferralHierarchy', ['hierarchy' => $hierarchy, 'id' => $this->session->get('username')]);
        }
    }

    function getlevelcountByid($id)
    {
        return $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT level,id, COUNT(*) AS node_count 
          FROM referrals WHERE id <> $id
          GROUP BY level;")->getResultArray();
    }
    function IndirectReferral()
    {
        $id = $this->session->get("user_id");
        $result = $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby,f_name,referralid, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby,u.f_name,u.referralid, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT level,id, f_name,referralid
          FROM referrals WHERE id <> $id AND referedby!=$id;")->getResultArray();
        return view("IndirectReferral", ['level' => $result]);
    }

    function listlevelcount()
    {
        $id = $this->session->get("user_id");
        $result = $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT (level-1), COUNT(*) AS node_count 
          FROM referrals WHERE (level-1)>0
          GROUP BY level;")->getResultArray();

        return view("listlevelcount", ['level' => $result]);
    }

    function levelwisecommision(){
        $id= $this->session->get('user_id');
        $loginController= new loginController();
        $firstDirect= $loginController->getCommisionfor1stLevel();
        return view('levelwisecommision',['firstDirect'=>$firstDirect]);

    }


    function getCommisionfor1stLevel(){
        $id = $this->session->get('user_id');
        $result = $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT (level-1), COUNT(*) AS node_count 
          FROM referrals WHERE (level-1)>0
          GROUP BY level;")->getResultArray();
            if(count($result)>0){
                $amount= 12200;
                $amount = ($amount * 2) / 730;
                if($result[0]['(level-1)']==1){

                    $commision=number_format(($amount * $result[0]['node_count']), 2);
                    if($commision>500){
                        $commision=500;
                    }
                    return ['totalreferral'=>$result[0]['node_count'],'commision'=>$commision]; 
                }else{
                    return 0;
                }

            }else{
                return 0;
            }

    }

    function getCommision()
    {
        $loginController= new loginController();
        echo $loginController->getCommisionfor1stLevel();
        // exit;
        $id = $this->session->get("user_id");
        $result = $this->db->query("WITH RECURSIVE referrals AS (
            SELECT id, referedby, 1 as level 
            FROM userlogin 
            WHERE id = $id
            UNION ALL 
            SELECT u.id, u.referedby, r.level + 1 as level 
            FROM userlogin u 
            INNER JOIN referrals r ON u.referedby = r.id 
          ) 
          SELECT (level-1), COUNT(*) AS node_count 
          FROM referrals WHERE (level-1)>0
          GROUP BY level;")->getResultArray();
          echo "<pre>";
          if(count($result)>0){
            foreach($result as $level){
                echo "<pre>";
                if($level['(level-1)']==1){
                   echo  $level['node_count'];
                    echo "hello";
                }
                print_r($level);
            }
          }
    // print_r($result);
        // exit;
        // $totalamount = ($totalamount * 2) / 730;
        // return $totalamount;
    }
}

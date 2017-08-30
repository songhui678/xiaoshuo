<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	public $username;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Admins::model()->find('username = :username and validate=1', array(':username'=>$this->username));

		if(isset($user)){

			if($user->post!=1){

				$site_user=Admins::model()->find('userid = :userid and validate=1 ', array(':userid'=>$user->site_id));

				if(!empty($site_user)){
					if($user->password!==md5($this->password)){

						$this->errorCode=self::ERROR_PASSWORD_INVALID;
					}else{
						
						// 记录登录ip
						$user->ip = Yii::app()->request->userHostAddress;
						$user->save(false);
						$this->setState('__id',$user->userid);
						//设置session信息
						$this->setState('username',$user->username);
						$this->setState('realname',$user->realname);
						$this->setState('userid',$user->userid);
						$this->setState('post',$user->post);
					    $this->setState('site_id',$user->site_id); 
			            $this->setState('cate',$user->cate); 
			            $this->setState('dep_id',$user->dep_id); 
						$this->setState('area',$user->area);
						$this->errorCode=self::ERROR_NONE;
						if($user->post==1||$user->post==4){
							$this->setState('type','');
						}else{
							$dep=Department::model()->find('id = :id', array(':id'=>$user->dep_id));
							if(!empty($dep)){
								$this->setState('type',$dep->type);
							}else{
								$this->setState('type','');
							}
						}
					}
				}else{
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
				}
			}else{

				if($user->password!==md5($this->password)){
					$this->errorCode=self::ERROR_PASSWORD_INVALID;	
				}else{
					// 记录登录ip
					$user->ip = Yii::app()->request->userHostAddress;
					$user->save(false);
					$this->setState('__id',$user->userid);
					//设置session信息
					$this->setState('username',$user->username);
					$this->setState('realname',$user->realname);
					$this->setState('userid',$user->userid);
					$this->setState('post',$user->post);
				    $this->setState('site_id',$user->site_id); 
		            $this->setState('cate',$user->cate); 
		            $this->setState('dep_id',$user->dep_id); 
					$this->setState('area',$user->area);

					if($user->post==1||$user->post==4){
							$this->setState('type','');
					}else{
						$dep=Department::model()->find('id = :id', array(':id'=>$user->dep_id));
						if(!empty($dep)){
							$this->setState('type',$dep->type);
						}else{
							$this->setState('type','');
						}
					}
					$this->errorCode=self::ERROR_NONE;
				}

			}

		}else{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		return !$this->errorCode;
	}

}
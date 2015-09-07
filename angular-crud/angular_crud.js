
    // define angular module/app
    var formApp = angular.module('formApp', []); 
	
		//// list students
		 formApp.controller('mainController', function ($scope, $http,$timeout) { 
		 $scope.addformtoggle  = true;
		 $scope.eidtformtoggle = true;
		 
	     $scope.GetStudents = function(){
		 $http.get('process.php?action=getList').
         success(function(data) {
		// console.log(data);
         // here the data from the api is assigned to a variable named users
          $scope.students = data;
         });
			 
		}
		
		
		///// get student record for edit form
		
		$scope.editStudent = function(index){
			
		//$("#hideshowformEdit").slideToggle();
		//$("#hideshowformAdd").hide();
		
			$http.post('process.php?action=getSingleStudent&student_id='+index).success(function(data){
				
				//$scope.eidtformtoggle = $scope.eidtformtoggle ? false : true;
				$scope.eidtformtoggle = false;
				$scope.addformtoggle  = true;

				$scope.first_name  = data[0]['first_name'];
				$scope.last_name   = data[0]['last_name'];
				$scope.email       = data[0]['email'];
				$scope.student_id  = data[0]['student_id'];
				
				}).error(function(data){
					
				});
			
			
		}
		
		$scope.processEditForm = function(){
			
			$http.post('process.php?action=updateStudent',
			{
			'student_id' : $scope.student_id,
			'first_name' : $scope.first_name,
			'last_name'	 : $scope.last_name,
			'email'      : $scope.email	
			}).success(function(data, status, headers, config){
				if (!data.success)
				 {
				  // if not successful, bind errors to error variables
				  $scope.errorFirstName  = data.errors.first_name;
				  $scope.errorLastName   = data.errors.last_name;
				  $scope.errorEmail      = data.errors.email;
				 }
				 else
				 {
				  // if successful, bind success message to message
				  $scope.eidtformtoggle = true;
				  $scope.errorName      = "";
				  $scope.errorSuperhero = "";
				  $scope.message        = data.message;
				  $timeout(function () { $scope.message = false; }, 3000); 
				   
				  
				  
				  $scope.GetStudents();
				}
				
				}).error(function(data, status, headers, config){
					
					
					})
			
			
			}
		
		//Delete Students
		////
		
		$scope.deleteStudent=function(index){
			var confirmval = confirm("Sure , you want to delete?");
			if(confirmval == false)
			return false;
			$http.post('process.php?action=deleteStudent&student_id='+index).success(function(data , status , header , config){
				console.log(data);
				$scope.successmessage = data['msg'];
				$timeout(function () { $scope.successmessage = false; }, 3000); 
				$scope.GetStudents();
				
				}).error(function(data , status , header,config){
					
					});
			
			} 
			 
			//// Add student form 
		
		$scope.addFormToggle = function(){
			$scope.addformtoggle = $scope.addformtoggle ? false : true;
			$scope.eidtformtoggle = true;
			// $scope.addformtoggle  = false;
			}	
		  $scope.formData = {};	 
	   	  $scope.processForm = function(){
		    $http({
			method  : 'POST',
			url     : 'process.php?action=addRecord',
			data    : $.param($scope.formData),  // pass in data as strings
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
		   }).success(function(data) {
				console.log(data);
			
				if (!data.success)
				 {
				  // if not successful, bind errors to error variables
				  $scope.errorFirstName  = data.errors.first_name;
				  $scope.errorLastName   = data.errors.last_name;
				  $scope.errorEmail      = data.errors.email;
				 }
				 else
				 {
				  // if successful, bind success message to message
				  $scope.errorName      = "";
				  $scope.errorSuperhero = "";
				  $scope.message        = data.message;
				  $scope.addformtoggle  = true;
				  $timeout(function () { $scope.message = false; }, 3000); 
				  $scope.GetStudents();
				}
                  });
			 }
			 		 
			 
			 
			 
			 
	 
		 
   
});



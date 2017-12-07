//Checking uploadHomework from User functionalities

public function testUserHomework() {
   require('uploadHomework.php');
   $this->assertEquals($uploadOk, $1);
}


public function testUserHomeworkDirectory() {
   require('uploadHomework.php');
   $this->assertEquals($target_dir, "submissions/");
}

public function testUserHomeworkExtension(){
  require('uploadHomework.php');
  $target_file = $target_dir;
  $this->assertEquals($imageFileType, pathinfo($target_file,PATHINFO_EXTENSION));
}
public function testUserHomeworkExtensionPDF(){
  require('uploadHomework.php');
  $target_file = $target_dir;
  $this->assertEquals($imageFileType, "pdf");
}

//Checking upload from teacher functionalities

public function testUpload() {
   require('upload.php');
   $this->assertEquals($uploadOk, $1);
}


public function testUploadDirectory() {
   require('upload.php');
   
   $this->assertEquals($target_dir, $target_dir.contains("guilds/"));
}

public function testUploadExtension(){
  require('upload.php');
  $target_file = $target_dir;
  $this->assertEquals($imageFileType, pathinfo($target_file,PATHINFO_EXTENSION));
}

public function testUploadExtensionPdf(){
  require('upload.php');
  $target_file = $target_dir;
  $this->assertEquals($imageFileType, "pdf");
}

//testing save scores

public function checkScoreInt(){
  require('saveScore.php');
  $this->assertInternalType("int", $value);
}

//Check update score

public function checkUpdateScoreInt(){
  require('updateScore.php');
  $this->assertInternalType("int", $value);
}



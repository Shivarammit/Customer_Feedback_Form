<html>
<head>
  <style>
    .form-section {
      display: none;
    }
  </style>
  <link rel="stylesheet" href="projectmaster.css">
</head>
<body>
  <div class="form_section">
  <form action="projectmaster.php" method="post">
    <label>What You want to do</label>
    <select id="form-select" onchange="displayForm()" name="action">
      <option value="">Select an Option</option>
      <option value="form1">New Project</option>
      <option value="form2">Update Project</option>
      <option value="form3">Delete Project</option>
      <option value="form4">View the Projects</option>
    </select><br><br>
    <div id="form1" class="form-section">
      <label>Project Number</label>
      <input type="text" name="pno1" id="pno1" placeholder="Project Number">
      <label>Project Name</label>
      <input type="text" name="pname" id="pname" placeholder="Project Name">
      <label>Client Name</label>
      <input type="text" name="cname" id="cname" placeholder="Client Name">
      <label>Contract Number</label>
      <input type="text" name="cno" id="cno" placeholder="Contract Number"><br><br>
      <button id="sub1">Submit</button>
    </div>

    <div id="form2" class="form-section">
      <label>Enter the project Number:</label>
      <input type="text" name="pno2" id="pno2"><br><br>
      <label>What you need to update</label>
      <select id="up-select" onchange="displayForm()" name="action1">
        <option value="">Select an Option</option>
        <option value="form6">Project Name</option>
        <option value="form7">Client Name</option>
        <option value="form8">Contract Number</option>
      </select>
      <div id="form6" class="form-section"> 
        <br><label>Project Name</label>
        <input type="text" name="pname1" id="pname1">
      </div>
      <div id="form7" class="form-section">
        <br><label>Client Name</label>
        <input type="text" name="cname1" id="cname1"> 
      </div>
      <div id="form8" class="form-section">
        <br><label>Contract Number</label>
        <input type="text" name="cno1" id="cno1">
    </div>
      <br><br><button id="sub2">Submit</button>
    </div>

    <div id="form3" class="form-section">
      <label>Enter the Project Number:</label>
      <input type="text" name="pno3" id="pno3" placeholder="Project Number"><br><br>
      <button id="sub3">Submit</button>
    </div>
    <div id="form4" class="form-section">
        <div id="project-list"></div>
      </div>
  </form>
  </div>

  <script>
    function displayForm() {
      var selectedValue = document.getElementById("form-select").value;
      var selected = document.getElementById("up-select").value;
      var forms = document.getElementsByClassName("form-section");

      // Hide all forms
      for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = "none";
      }

      // Show the selected form
      if (selectedValue) {
        document.getElementById(selectedValue).style.display = "block";
      }
      if(selected){
        document.getElementById(selected).style.display = "block";
      }
      if (selectedValue == 'form4'){
        fetch('projectdata.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('project-list').innerHTML = data;
        })
        .catch(error => console.error('Error fetching project data:', error));
      }
    }
    const urlParams = new URLSearchParams(window.location.search);
    const operation=urlParams.get('operation');
    if (operation === 'insert'){
      alert('New Projected has been created');
    }
    if (operation === 'update'){
      alert('Project Updated Successfully');
    }
    if (operation === 'delete'){
      alert('Project has been deleted sucessfully');
    }
    if (operation === 'notfound'){
      alert('Project has been deleted sucessfully');
    }
    document.getElementById('pno1').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('cname').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('cno').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('pno2').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('pname1').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('cno1').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('cname1').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
        document.getElementById('pno3').addEventListener('input', function(event) {
            event.target.value = event.target.value.toUpperCase();
        });
  </script>
</body>
</html>
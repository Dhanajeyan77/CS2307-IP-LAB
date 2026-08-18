document.getElementById("registrationForm").addEventListener("submit", function(e) {
  e.preventDefault();

  let isValid = true;


  document.querySelectorAll('.error').forEach(el => el.textContent = "");
  document.getElementById("successMsg").textContent = "";


  const fullName = document.getElementById("fullName").value.trim();
  if (fullName === "") {
    document.getElementById("fullNameError").textContent = "Full name is required.";
    isValid = false;
  }

  
  const email = document.getElementById("email").value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    document.getElementById("emailError").textContent = "Email is required.";
    isValid = false;
  } else if (!emailPattern.test(email)) {
    document.getElementById("emailError").textContent = "Please enter a valid email address.";
    isValid = false;
  }

 
  const phone = document.getElementById("phone").value.trim();
  const phonePattern = /^[0-9]{10}$/;
  if (phone === "") {
    document.getElementById("phoneError").textContent = "Phone number is required.";
    isValid = false;
  } else if (!phonePattern.test(phone)) {
    document.getElementById("phoneError").textContent = "Enter a valid 10 digit phone number.";
    isValid = false;
  }

  
  const password = document.getElementById("password").value;
  if (password === "") {
    document.getElementById("passwordError").textContent = "Password is required.";
    isValid = false;
  } else if (password.length < 6) {
    document.getElementById("passwordError").textContent = "Password must be at least 6 characters.";
    isValid = false;
  }

  
  const jobTitle = document.getElementById("jobTitle").value.trim();
  if (jobTitle === "") {
    document.getElementById("jobTitleError").textContent = "Desired job title is required.";
    isValid = false;
  }

  
  const experience = document.getElementById("experience").value;
  if (experience === "") {
    document.getElementById("experienceError").textContent = "Experience is required.";
    isValid = false;
  } else if (experience < 0) {
    document.getElementById("experienceError").textContent = "Experience cannot be negative.";
    isValid = false;
  }


  const resumeLink = document.getElementById("resumeLink").value.trim();
  const urlPattern = /^(https?:\/\/)[^\s]+$/;
  if (resumeLink !== "" && !urlPattern.test(resumeLink)) {
    document.getElementById("resumeLinkError").textContent = "Enter a valid URL starting with http:// or https://";
    isValid = false;
  }

  
  const resumeFile = document.getElementById("resumeFile").value;
  if (resumeFile === "") {
    document.getElementById("resumeFileError").textContent = "Please upload your resume.";
    isValid = false;
  } else {
    const allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
    if (!allowedExtensions.test(resumeFile)) {
      document.getElementById("resumeFileError").textContent = "Only PDF or DOC/DOCX files are allowed.";
      isValid = false;
    }
  }

  if (isValid) {
    document.getElementById("successMsg").textContent = "Registration successful!";
    document.getElementById("registrationForm").reset();
  }
});


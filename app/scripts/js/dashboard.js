/* aktualní čas */
const datetimeElement = document.getElementById("datetime");
const now = new Date();
const offset = now.getTimezoneOffset() * 60000;
const localTime = new Date(now.getTime() - offset);
const datetimeString = localTime.toISOString().slice(0, 16);
datetimeElement.value = datetimeString;

/* funkce navigace - dashboard*/
const newMeetBtn = document.getElementById("new_meet");
const myMeetBtn = document.getElementById("my_meets");
const userSetBtn = document.getElementById("user_settings");
const meetFormDiv = document.getElementById("meet_form");
const myFormDiv = document.getElementById("my_form");
const setFormDiv = document.getElementById("set_form");

newMeetBtn.addEventListener("click", () => {
  if (meetFormDiv.style.display === "none") {
    meetFormDiv.style.display = "block";
    myFormDiv.style.display = "none";
    setFormDiv.style.display = "none";
  } else {
    meetFormDiv.style.display = "none";
    myFormDiv.style.display = "none";
    setFormDiv.style.display = "none";
  }
});
myMeetBtn.addEventListener("click", () => {
    if (myFormDiv.style.display === "block") {
      myFormDiv.style.display = "none";
    } else {
      myFormDiv.style.display = "block";
      meetFormDiv.style.display = "none";
      setFormDiv.style.display = "none"
    }
});
userSetBtn.addEventListener("click", () => {
    if (setFormDiv.style.display === "block") {
      setFormDiv.style.display = "none";
    } else {
      setFormDiv.style.display = "block";
      myFormDiv.style.display = "none";
      meetFormDiv.style.display = "none";
    }
});

/* funkce sidebar - dashboard */
const profileBtn = document.getElementById("profile_btn");
const emailBtn = document.getElementById("email_btn");
const passwordBtn = document.getElementById("password_btn");
const profileForm = document.getElementById("profile_form");
const profileFormName = document.getElementById("profile_form_name");
const emailForm = document.getElementById("email_form");
const passwordForm = document.getElementById("password_form");

let Visible = false;

profileBtn.addEventListener("click", () => {
  if (profileForm.style.display === "none" && profileFormName.style.display === "none") {
    profileForm.style.display = "block";
    profileFormName.style.display = "block";
    emailForm.style.display = "none";
    passwordForm.style.display = "none";
  } else {
    emailForm.style.display = "none";
    passwordForm.style.display = "none";
  }
});
  
emailBtn.addEventListener("click", () => {
  if (emailForm.style.display === "none") {
    emailForm.style.display = "block";
    profileForm.style.display = "none";
    profileFormName.style.display = "none";
    passwordForm.style.display = "none";
  }
});
  
passwordBtn.addEventListener("click", () => {
  if (passwordForm.style.display === "none") {
    passwordForm.style.display = "block";
    profileForm.style.display = "none";
    profileFormName.style.display = "none";
    emailForm.style.display = "none";
  }
});
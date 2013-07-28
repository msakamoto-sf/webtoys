function getkey_l()
{
  alert(localStorage.testkey);
}
function setkey_l()
{
  localStorage.testkey = document.forms[0].testkey.value;
}
function getkey_s()
{
  alert(sessionStorage.testkey);
}
function setkey_s()
{
  sessionStorage.testkey = document.forms[0].testkey.value;
}

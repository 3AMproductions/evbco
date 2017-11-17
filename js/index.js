document.addEventListener("DOMContentLoaded", function(event) {
  document.querySelectorAll('#nav li').forEach(function(li) {
    var a = li.querySelector('a')
    if(a && a.href == document.location) {
      a.classList.add('location');
      (li.parentNode.closest('li') || li)
        .classList.add('active')
    }
  })
})


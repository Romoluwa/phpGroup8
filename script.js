// script.js - dark theme UI helpers

// small glow on hover for buttons
document.querySelectorAll("button").forEach((btn) => {
  btn.addEventListener("mouseover", () => {
    btn.style.boxShadow = "0 0 15px #00eaff";
  });
  btn.addEventListener("mouseout", () => {
    btn.style.boxShadow = "none";
  });
});

// fade-in containers
window.addEventListener("load", () => {
  document.querySelectorAll('.fade-in').forEach(c => {
    c.style.opacity = 0;
    c.style.transform = 'translateY(6px)';
    setTimeout(() => {
      c.style.transition = 'all 0.6s ease';
      c.style.opacity = 1;
      c.style.transform = 'translateY(0)';
    }, 120);
  });
});

// small confirm step for manual non-AJAX forms (keeps safety)
document.addEventListener('submit', function(e) {
  const form = e.target;
  if (form.matches && form.matches('.vote-form')) {
    // handled by AJAX in vote.php - do not double-confirm here
    return;
  }
  // fallback: if any form has a data-confirm attribute
  if (form.dataset && form.dataset.confirm === "true") {
    if (!confirm(form.dataset.confirmMessage || "Are you sure?")) {
      e.preventDefault();
    }
  }
});

// input focus glow
document.querySelectorAll("input, select, textarea").forEach(input => {
  input.addEventListener('focus', () => {
    input.style.boxShadow = "0 0 10px rgba(0, 234, 255, 0.12)";
  });
  input.addEventListener('blur', () => {
    input.style.boxShadow = "none";
  });
});

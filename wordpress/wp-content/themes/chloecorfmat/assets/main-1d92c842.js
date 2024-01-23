(function polyfill() {
  const relList = document.createElement("link").relList;
  if (relList && relList.supports && relList.supports("modulepreload")) {
    return;
  }
  for (const link of document.querySelectorAll('link[rel="modulepreload"]')) {
    processPreload(link);
  }
  new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      if (mutation.type !== "childList") {
        continue;
      }
      for (const node of mutation.addedNodes) {
        if (node.tagName === "LINK" && node.rel === "modulepreload")
          processPreload(node);
      }
    }
  }).observe(document, { childList: true, subtree: true });
  function getFetchOpts(link) {
    const fetchOpts = {};
    if (link.integrity)
      fetchOpts.integrity = link.integrity;
    if (link.referrerPolicy)
      fetchOpts.referrerPolicy = link.referrerPolicy;
    if (link.crossOrigin === "use-credentials")
      fetchOpts.credentials = "include";
    else if (link.crossOrigin === "anonymous")
      fetchOpts.credentials = "omit";
    else
      fetchOpts.credentials = "same-origin";
    return fetchOpts;
  }
  function processPreload(link) {
    if (link.ep)
      return;
    link.ep = true;
    const fetchOpts = getFetchOpts(link);
    fetch(link.href, fetchOpts);
  }
})();
const all_min = "";
const styles = "";
const blocks = "";
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("js--header-burger__button").addEventListener("click", toggleHeaderBurger);
  function toggleHeaderBurger() {
    document.getElementById("js--header-burger__button--open").classList.toggle("header-banner__burger--open-selected");
    document.getElementById("js--header-burger__button--open").classList.toggle("header-banner__burger--open");
    document.getElementById("js--header-burger__button--close").classList.toggle("header-banner__burger--close-selected");
    document.getElementById("js--header-burger__button--close").classList.toggle("header-banner__burger--close");
    document.getElementById("js--header-nav").classList.toggle("header-nav");
    document.getElementById("js--header-nav").classList.toggle("header-nav--show");
    document.getElementById("js--header-social").classList.toggle("header-social");
    document.getElementById("js--header-social").classList.toggle("header-social--show");
  }
});
document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll(".switcher__item").forEach(function(element) {
    element.addEventListener("click", function() {
      document.querySelectorAll(".switcher__item--active").forEach(function(element2) {
        element2.classList.remove("switcher__item--active");
      });
      this.classList.add("switcher__item--active");
      if (this.dataset.foldable === "true") {
        document.querySelectorAll(".cards-item__content--unfold").forEach(function(element2) {
          element2.setAttribute("aria-hidden", "true");
        });
      } else {
        document.querySelectorAll(".cards-item__content--unfold").forEach(function(element2) {
          element2.setAttribute("aria-hidden", "false");
        });
      }
    });
  });
});
class Checkbox {
  constructor(domNode) {
    this.domNode = domNode;
    this.domNode.tabIndex = 0;
    if (!this.domNode.getAttribute("aria-checked")) {
      this.domNode.setAttribute("aria-checked", "false");
    }
    this.domNode.addEventListener("keydown", this.onKeydown.bind(this));
    this.domNode.addEventListener("keyup", this.onKeyup.bind(this));
    this.domNode.addEventListener("click", this.onClick.bind(this));
  }
  toggleCheckbox() {
    if (this.domNode.getAttribute("aria-checked") === "true") {
      this.domNode.setAttribute("aria-checked", "false");
    } else {
      this.domNode.setAttribute("aria-checked", "true");
    }
  }
  /* EVENT HANDLERS */
  // Make sure to prevent page scrolling on space down
  onKeydown(event) {
    if (event.key === " ") {
      event.preventDefault();
    }
  }
  onKeyup(event) {
    var flag = false;
    switch (event.key) {
      case " ":
        this.toggleCheckbox();
        flag = true;
        break;
    }
    if (flag) {
      event.stopPropagation();
    }
  }
  onClick() {
    this.toggleCheckbox();
  }
}
window.addEventListener("load", function() {
  let checkboxes = document.querySelectorAll('[role="checkbox"]');
  for (let i = 0; i < checkboxes.length; i++) {
    new Checkbox(checkboxes[i]);
  }
});

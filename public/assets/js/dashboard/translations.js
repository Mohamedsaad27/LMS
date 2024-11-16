import translations from "./languages.js";

document.querySelectorAll("input[name='language']").forEach(languageOption => {
    languageOption.addEventListener("change", (event) => {
        console.log(event.target.value);
        setLanguage(event.target.value);
        localStorage.setItem("lang", event.target.value);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const language = localStorage.getItem("lang") || "en";
    const languageOption = document.querySelector(`input[name='language'][value='${language}']`);
    if (languageOption) {
        languageOption.checked = true;
    }
    setLanguage(language);
});

const setLanguage = (language) => {
    const elements = document.querySelectorAll("[data-i18n]");
    const inputElements = document.querySelectorAll("[input-data-i18n]");
    elements.forEach((element) => {
        const translationKey = element.getAttribute("data-i18n");
        element.textContent = translations[language][translationKey];
    });
    inputElements.forEach((element) => {
        const translationKey = element.getAttribute("input-data-i18n");
        element.placeholder = translations[language][translationKey];
    })
    document.dir = language === "ar" ? "rtl" : "ltr";
    document.querySelectorAll('link[rel="stylesheet"]').forEach(style => {
        if (style.href.includes('/assets/css/dashboard/rtl.css') || style.href.includes('/assets/css/dashboard/ltr.css')) {
            style.remove();
        }
    });
    const styleFile = document.createElement('link');
    styleFile.rel = 'stylesheet';
    styleFile.type = 'text/css';
    styleFile.href = language === "ar" ? '/assets/css/dashboard/rtl.css' : '/assets/css/dashboard/ltr.css';
    document.head.appendChild(styleFile);
};
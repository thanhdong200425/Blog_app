const {
    ClassicEditor,
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    BalloonToolbar,
    BlockQuote,
    BlockToolbar,
    Bold,
    Bookmark,
    CloudServices,
    Code,
    CodeBlock,
    Essentials,
    FindAndReplace,
    Heading,
    Highlight,
    HorizontalLine,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    Paragraph,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Table,
    TableCellProperties,
    TableProperties,
    TableToolbar,
    TextTransformation,
    TodoList,
    Underline,
} = window.CKEDITOR;
const { CaseChange, FormatPainter, Template } = window.CKEDITOR_PREMIUM_FEATURES;

const LICENSE_KEY = "eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDAwOTU5OTksImp0aSI6ImE2Yjk1YTAxLWI4ZDEtNDQ0Ni04Mzc0LTQzNDA4ZWJlMTc0ZCIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImZlNzE3M2Y1In0.Pz3uA6Jg13DlM27yIe6bup0liLMedl7sKHJKPKyjtYYao18d2VleEu-pEptRfqSHVOYstbeYKaNNDmBvMgDDmg";

const editorConfig = {
    toolbar: {
        items: ["formatPainter", "|", "heading", "|", "bold", "italic", "underline", "|", "link", "insertTable", "highlight", "blockQuote", "codeBlock", "|", "bulletedList", "numberedList", "todoList", "outdent", "indent"],
        shouldNotGroupWhenFull: false,
    },
    plugins: [
        Autoformat,
        AutoImage,
        AutoLink,
        Autosave,
        BalloonToolbar,
        BlockQuote,
        BlockToolbar,
        Bold,
        Bookmark,
        CaseChange,
        CloudServices,
        Code,
        CodeBlock,
        Essentials,
        FindAndReplace,
        FormatPainter,
        Heading,
        Highlight,
        HorizontalLine,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        Paragraph,
        SpecialCharacters,
        SpecialCharactersArrows,
        SpecialCharactersCurrency,
        SpecialCharactersEssentials,
        SpecialCharactersLatin,
        SpecialCharactersMathematical,
        SpecialCharactersText,
        Strikethrough,
        Table,
        TableCellProperties,
        TableProperties,
        TableToolbar,
        Template,
        TextTransformation,
        TodoList,
        Underline,
    ],
    balloonToolbar: ["bold", "italic", "|", "link", "|", "bulletedList", "numberedList"],
    blockToolbar: ["bold", "italic", "|", "link", "insertTable", "|", "bulletedList", "numberedList", "outdent", "indent"],
    heading: {
        options: [
            {
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph",
            },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1",
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2",
            },
            {
                model: "heading3",
                view: "h3",
                title: "Heading 3",
                class: "ck-heading_heading3",
            },
            {
                model: "heading4",
                view: "h4",
                title: "Heading 4",
                class: "ck-heading_heading4",
            },
            {
                model: "heading5",
                view: "h5",
                title: "Heading 5",
                class: "ck-heading_heading5",
            },
            {
                model: "heading6",
                view: "h6",
                title: "Heading 6",
                class: "ck-heading_heading6",
            },
        ],
    },
    image: {
        toolbar: ["toggleImageCaption", "imageTextAlternative", "|", "imageStyle:inline", "imageStyle:wrapText", "imageStyle:breakText", "|", "resizeImage"],
    },
    initialData: "",
    licenseKey: LICENSE_KEY,
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: "https://",
        decorators: {
            toggleDownloadable: {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "file",
                },
            },
        },
    },
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
    menuBar: {
        isVisible: true,
    },
    placeholder: "Type or paste your content here!",
    table: {
        contentToolbar: ["tableColumn", "tableRow", "mergeTableCells", "tableProperties", "tableCellProperties"],
    },
    template: {
        definitions: [
            {
                title: "Introduction",
                description: "Simple introduction to an article",
                icon: '<svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">\n    <g id="icons/article-image-right">\n        <rect id="icon-bg" width="45" height="45" rx="2" fill="#A5E7EB"/>\n        <g id="page" filter="url(#filter0_d_1_507)">\n            <path d="M9 41H36V12L28 5H9V41Z" fill="white"/>\n            <path d="M35.25 12.3403V40.25H9.75V5.75H27.7182L35.25 12.3403Z" stroke="#333333" stroke-width="1.5"/>\n        </g>\n        <g id="image">\n            <path id="Rectangle 22" d="M21.5 23C21.5 22.1716 22.1716 21.5 23 21.5H31C31.8284 21.5 32.5 22.1716 32.5 23V29C32.5 29.8284 31.8284 30.5 31 30.5H23C22.1716 30.5 21.5 29.8284 21.5 29V23Z" fill="#B6E3FC" stroke="#333333"/>\n            <path id="Vector 1" d="M24.1184 27.8255C23.9404 27.7499 23.7347 27.7838 23.5904 27.9125L21.6673 29.6268C21.5124 29.7648 21.4589 29.9842 21.5328 30.178C21.6066 30.3719 21.7925 30.5 22 30.5H32C32.2761 30.5 32.5 30.2761 32.5 30V27.7143C32.5 27.5717 32.4391 27.4359 32.3327 27.3411L30.4096 25.6268C30.2125 25.451 29.9127 25.4589 29.7251 25.6448L26.5019 28.8372L24.1184 27.8255Z" fill="#44D500" stroke="#333333" stroke-linejoin="round"/>\n            <circle id="Ellipse 1" cx="26" cy="25" r="1.5" fill="#FFD12D" stroke="#333333"/>\n        </g>\n        <rect id="Rectangle 23" x="13" y="13" width="12" height="2" rx="1" fill="#B4B4B4"/>\n        <rect id="Rectangle 24" x="13" y="17" width="19" height="2" rx="1" fill="#B4B4B4"/>\n        <rect id="Rectangle 25" x="13" y="21" width="6" height="2" rx="1" fill="#B4B4B4"/>\n        <rect id="Rectangle 26" x="13" y="25" width="6" height="2" rx="1" fill="#B4B4B4"/>\n        <rect id="Rectangle 27" x="13" y="29" width="6" height="2" rx="1" fill="#B4B4B4"/>\n        <rect id="Rectangle 28" x="13" y="33" width="16" height="2" rx="1" fill="#B4B4B4"/>\n    </g>\n    <defs>\n        <filter id="filter0_d_1_507" x="9" y="5" width="28" height="37" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">\n            <feFlood flood-opacity="0" result="BackgroundImageFix"/>\n            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>\n            <feOffset dx="1" dy="1"/>\n            <feComposite in2="hardAlpha" operator="out"/>\n            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.29 0"/>\n            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1_507"/>\n            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1_507" result="shape"/>\n        </filter>\n    </defs>\n</svg>\n',
                data: "<h2>Introduction</h2><p>In today's fast-paced world, keeping up with the latest trends and insights is essential for both personal growth and professional development. This article aims to shed light on a topic that resonates with many, providing valuable information and actionable advice. Whether you're seeking to enhance your knowledge, improve your skills, or simply stay informed, our comprehensive analysis offers a deep dive into the subject matter, designed to empower and inspire our readers.</p>",
            },
        ],
    },
};

configUpdateAlert(editorConfig);
let newEditor;
const editorElement = document.querySelector("#editor");
// Decode HTML entities in the initial content
const tempDiv = document.createElement("div");
tempDiv.innerHTML = editorElement.innerHTML;
const initialContent = tempDiv.textContent;

ClassicEditor.create(editorElement, {
    ...editorConfig,
    initialData: initialContent,
}).then((editor) => {
    newEditor = editor;
    const wordCount = editor.plugins.get("WordCount");
    document.querySelector("#editor-word-count").appendChild(wordCount.wordCountContainer);
    validateFormBeforeSubmitting();
});

/**
 * This function exists to remind you to update the config needed for premium features.
 * The function can be safely removed. Make sure to also remove call to this function when doing so.
 */
function configUpdateAlert(config) {
    if (configUpdateAlert.configUpdateAlertShown) {
        return;
    }

    const isModifiedByUser = (currentValue, forbiddenValue) => {
        if (currentValue === forbiddenValue) {
            return false;
        }

        if (currentValue === undefined) {
            return false;
        }

        return true;
    };

    const valuesToUpdate = [];

    configUpdateAlert.configUpdateAlertShown = true;

    if (!isModifiedByUser(config.licenseKey, "<YOUR_LICENSE_KEY>")) {
        valuesToUpdate.push("LICENSE_KEY");
    }

    if (valuesToUpdate.length) {
        window.alert(["Please update the following values in your editor config", "to receive full access to Premium Features:", "", ...valuesToUpdate.map((value) => ` - ${value}`)].join("\n"));
    }
}

// Handle form submission
const handleSubmission = () => {
    document.querySelector("#post-form").addEventListener("submit", (e) => {
        event.preventDefault();
        // Create hidden input
        const form = document.querySelector("#post-form"),
            submitButton = document.querySelector("#submit-button");
        const formContent = document.createElement("input");
        formContent.type = "hidden";
        formContent.name = "content";
        formContent.value = newEditor.getData();
        form.appendChild(formContent);
        submitButton.classList.add("waiting");
        setTimeout(() => form.submit(), 2000);
    });
};

// Validate form before submitting
const validateFormBeforeSubmitting = () => {
    const formTitle = document.querySelector("#article-title");
    const submitButton = document.querySelector("#submit-button");
    let isEditorHasContent = false;

    newEditor.model.document.on("change:data", () => {
        isEditorHasContent = newEditor.getData().length > 0;
        checkValidity();
    });

    const checkValidity = () => (submitButton.disabled = formTitle.value.length === 0 || !isEditorHasContent);

    formTitle.addEventListener("input", checkValidity);
    checkValidity();
};

document.addEventListener("DOMContentLoaded", () => {
    handleSubmission();
    validateFormBeforeSubmitting();
});

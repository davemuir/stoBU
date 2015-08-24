<?php defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header_top.php');
$as = new GlobalArea('Header Search');
$blocks = $as->getTotalBlocksInArea();
$displayThirdColumn = $blocks > 0 || $c->isEditMode();

?>
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">
<script src="http://sto.apengage.io/streetsto/concrete/js/uisearch.js"></script>
<script src="http://sto.apengage.io/streetsto/concrete/js/classie.js"></script>
<svg display="none" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<symbol id="icon-13" viewBox="0 0 1024 1024">
    <title>lounge</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M824.297 311.278c5.986-6.269 7.672-15.534 4.256-23.491-3.404-7.954-11.252-13.142-19.917-13.142h-164.917l25.082-53.768c23.917 7.559 49.613-2.124 59.783-23.863 10.134-21.721 1.022-47.604-20.124-61.1l5.372-11.518c1.688-3.641 0.127-7.909-3.5-9.599-3.623-1.688-7.909-0.125-9.591 3.498l-5.38 11.518c-23.937-7.559-49.617 2.124-59.769 23.863-10.15 21.719-1.018 47.606 20.126 61.098l-27.953 59.851h-413.987c-8.673 0-16.503 5.163-19.911 13.14-3.414 7.975-1.726 17.242 4.262 23.486l293.313 306.452v255.41h-81.48c-10.471 0-18.958 8.501-18.958 18.977 0 10.451 8.466 18.969 18.958 18.969h202.519c10.463 0 18.96-8.491 18.96-18.969 0-10.457-8.475-18.977-18.96-18.977h-81.506v-255.386l293.323-306.45zM607.558 317.962l-28.041 60.16h-225.714l157.432 164.471 157.434-164.471h-73.196l28.037-60.16h134.4l-246.678 257.743-246.716-257.743h343.042z"></path>
</symbol>
<symbol id="icon-12" viewBox="0 0 1024 1024">
    <title>spa</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M625.775 845.115h-487.993v-45.505c8.878 7.059 20.214 11.342 32.422 11.342h421.882l33.69 34.163zM348.961 176.935c-26.159 0-47.405 21.244-47.405 47.403 0 16.251 8.165 30.599 20.691 39.16 5.39-14.901 14.111-28.619 25.684-40.19 11.573-11.573 25.289-20.294 40.192-25.684-8.563-12.524-22.911-20.689-39.162-20.689zM335.403 301.154c0 49.94 40.509 90.37 90.37 90.37 49.863 0 90.37-40.509 90.37-90.37 0-49.94-40.507-90.368-90.37-90.368-10.621 0-20.769 1.823-30.202 5.151-25.604 9.118-45.978 29.411-55.015 55.015-3.328 9.511-5.153 19.657-5.153 30.202zM286.335 425.847c-21.166 46.93-67.301 166.867-79.985 197.067h157.434c3.488-8.559 7.373-16.88 11.651-24.726 14.823-27.668 61.118-41.384 50.1-79.989-0.080-0.315-0.238-0.637-0.317-1.032l41.462 39.318c3.088 2.937 6.816 5.315 10.779 6.82l113.359 43.28c3.805 1.43 7.768 2.14 11.653 2.14 13.158 0 25.528-8.004 30.439-21.004 6.42-16.804-1.987-35.674-18.868-42.097l-100.198-38.287c-4.68-1.823-8.96-4.518-12.603-7.928 0 0-88.23-83.712-88.31-83.79-3.723-3.566-8.561-5.865-13.634-7.53-1.19-0.397-2.46-0.793-3.725-1.11-1.348-0.397-2.773-0.793-4.2-1.11-22.041-5.868-46.533-10.861-69.204-8.878-7.453 0.635-15.618 2.537-21.959 6.896-7.293 5.235-10.306 14.115-13.873 21.961zM170.203 791.13h430.127l41.22 41.775c3.883 3.965 8.563 7.057 13.554 9.116 4.917 1.985 10.152 3.092 15.542 3.092h175.665c22.827 0 41.22-18.708 40.905-41.538-0.397-22.432-19.106-40.19-41.54-40.19h-157.909l-107.334-108.919c-8.323-8.485-13.236-11.973-28.142-11.973-25.682 0-382.087 0.238-382.087 0.238-17.916 0-32.422 14.508-32.422 32.422v83.554c-0.002 17.916 14.504 32.422 32.42 32.422zM828.236 641.626c0-51.763-42.017-93.778-93.778-93.778s-93.778 42.015-93.778 93.778 42.017 93.778 93.778 93.778 93.778-41.937 93.778-93.778z"></path>
</symbol>
<symbol id="icon-11" viewBox="0 0 1024 1024">
    <title>pet</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M235.631 498.823c0 0-13.539 193.051-39.512 268.691s-7.903 118.54 24.832 123.052c32.737 4.514 85.803-214.51 86.929-226.927 1.124-12.415 33.876 227.060 92.582 226.984 58.708-0.070-2.263-204.415-6.779-214.569-4.514-10.168 115.151 25.973 142.248 28.219 27.093 2.267-71.125 167.229-1.124 186.348 70.001 19.124 79.026-146.833 79.026-162.638 0-15.809 53.051 179.323 114.024 164.174 60.973-15.147-33.874-193.52-54.19-226.271 0 0 62.093-141.119 64.344-169.343 0 0 103.86 12.415 118.542 10.164 14.678-2.261 72.247-66.607 56.445-75.635-15.809-9.030-76.78-58.708-85.803-95.957-9.030-37.249-95.959-57.582-217.905-31.611 0 0 31.613 29.346 47.417 31.611 10.402 1.491-28.090 48.773-72.978 81.058l-432.779-282.014-17.834 21.402 420.536 279.089c-13.703 6.793-27.142 11.102-39.178 11.102-60.959 0-309.342 38.388-377.078-71.125 0 0-22.583-1.122-29.348 20.318-6.781 21.461 5.652 72.266 127.582 103.877z"></path>
</symbol>
<symbol id="icon-10" viewBox="0 0 1024 1024">
    <title>nightlife</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M291.727 261.829c7.627-10.009 7.969-24.087 1.663-35.099-6.82-11.907-36.631-34.591-20.167-47.786 9.138-7.324-3.797-20.087-12.841-12.843-10.721 8.593-11.741 21.785-8.012 34.275 4.97 16.644 37.632 33.964 23.679 52.283-7.107 9.32 8.677 18.35 15.677 9.169z"></path>
    <path class="path3" d="M765.084 184.226c11.649-1.18 7.731-18.926-3.795-17.758-13.67 1.384-21.697 11.897-25.356 24.41-4.876 16.673 13.119 48.966-8.548 56.752-11.028 3.963-2.689 20.12 8.172 16.216 11.848-4.256 19.786-15.886 20.48-28.553 0.745-13.701-11.942-48.941 9.048-51.067z"></path>
    <path class="path4" d="M409.424 259.83c1.95 12.536 11.008 23.323 23.214 26.376 11.201 2.804 17.889-14.1 6.527-16.947-22.338-5.597-7.639-39.516-14.148-55.624-4.884-12.089-13.916-21.756-27.658-21.77-11.586-0.014-13.724 18.031-2.011 18.045 21.086 0.031 11.969 36.362 14.076 49.92z"></path>
    <path class="path5" d="M631.339 194.746c5.339-11.897 6.058-25.106-3.449-35.031-8.008-8.37-22.512 2.587-14.412 11.045 14.59 15.239-17.936 33.821-26.259 44.728-7.696 10.088-9.204 24.089-2.953 35.013 5.732 10.019 22.561 3.142 16.749-7.031-11.432-19.986 23.218-32.87 30.325-48.724z"></path>
    <path class="path6" d="M467.417 213.776c4.862 11.721 16.218 20.052 28.799 20.128 11.547 0.074 14.039-17.936 2.324-18.012-23.028-0.145-16.781-36.583-26.921-50.688-7.614-10.588-18.676-17.84-32.029-14.598-11.264 2.732-9.064 20.771 2.314 18.010 20.511-4.973 20.255 32.485 25.512 45.16z"></path>
    <path class="path7" d="M339.137 263.44c16.394 0 16.394-25.422 0-25.422-16.392 0-16.392 25.422 0 25.422z"></path>
    <path class="path8" d="M217.475 227.121c16.392 0 16.392-25.422 0-25.422s-16.392 25.422 0 25.422z"></path>
    <path class="path9" d="M558.854 169.015c-16.39 0-16.39 25.422 0 25.422 16.394 0 16.394-25.422 0-25.422z"></path>
    <path class="path10" d="M535.249 259.807c16.396 0 16.396-25.422 0-25.422-16.392 0-16.392 25.422 0 25.422z"></path>
    <path class="path11" d="M675.070 221.676c16.394 0 16.394-25.422 0-25.422-16.392 0-16.394 25.422 0 25.422z"></path>
    <path class="path12" d="M820.339 223.492c-16.394 0-16.394 25.422 0 25.422s16.394-25.422 0-25.422z"></path>
    <path class="path13" d="M594.862 511.195l58.262-88.398c2.689-4.078 4.123-8.854 4.123-13.736v-176.136c0-0.612-0.049-1.212-0.092-1.815-0.934-12.935-11.698-23.144-24.875-23.144-13.791 0-24.961 11.178-24.961 24.961v168.647l-38.793 58.855h-99.486l-41.718-44.038 11.518-47.989c0.010-0.045 0.012-0.096 0.029-0.141 0.152-0.659 0.27-1.315 0.367-1.968 0.031-0.326 0.086-0.643 0.127-0.971 0.322-2.861 0.133-5.687-0.5-8.387-0.596-2.562-1.575-5.005-2.916-7.234-3.332-5.528-8.786-9.775-15.555-11.403-0.162-0.039-0.315-0.051-0.475-0.088-1.808-0.397-3.609-0.614-5.386-0.614-0.096 0-0.188 0.023-0.285 0.023-11.155 0.127-21.23 7.78-23.951 19.118l-1.051 4.393-1.628 6.783-11.993 49.986c-1.974 8.212 0.342 16.865 6.146 22.997l81.725 86.313v85.15l-3.262 3.981-79.661 97.372c-8.362 10.232-7.318 25.194 2.39 34.159l63.603 58.716c4.798 4.428 10.873 6.613 16.925 6.613 6.724 0 13.429-2.699 18.346-8.030 9.351-10.131 8.718-25.917-1.411-35.279l-46.318-42.76 42.076-51.421h60.191v171.248c0 13.783 11.182 24.961 24.963 24.961 13.787 0 24.961-11.178 24.961-24.961v-207.938c0-1.698-0.178-3.353-0.5-4.956v-109.105l9.066-13.763z"></path>
    <path class="path14" d="M463.44 387.682c3.82 15.985 14.254 29.391 28.305 37.102 5.112 2.8 10.701 4.839 16.605 5.982 3.578 0.694 7.258 1.085 11.031 1.085 22.612 0 42.125-13.072 51.54-32.043 2.2-4.428 3.889-9.146 4.893-14.129 0.739-3.684 1.143-7.5 1.143-11.407 0-4.502-0.569-8.858-1.546-13.058-3.031-13.066-10.498-24.406-20.754-32.375-1.843-1.43-3.772-2.74-5.773-3.942-3.49-2.087-7.201-3.83-11.123-5.149-4.891-1.649-10.080-2.63-15.462-2.902-0.969-0.051-1.927-0.147-2.916-0.147-8.362 0-16.292 1.825-23.462 5.034-2.441 1.087-4.776 2.357-7.025 3.762-14.578 9.134-24.789 24.568-26.737 42.521-0.035 0.326-0.041 0.651-0.086 0.977-0.141 1.548-0.219 3.117-0.24 4.696 0 0.193-0.027 0.383-0.027 0.582 0 1.86 0.109 3.697 0.279 5.509 0.258 2.703 0.741 5.329 1.356 7.903z"></path>
</symbol>
<symbol id="icon-9" viewBox="0 0 1024 1024">
    <title>fitness</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M413.022 788.312c6.316 6.316 5.865 12.638-1.356 18.958l-29.802 28.451c-6.322 6.32-12.642 5.87-18.964-1.356l-176.101-188.291c-6.322-7.225-5.87-13.998 1.356-20.32l29.802-28.447c6.322-6.318 12.642-5.868 18.964 1.354l176.101 189.651z"></path>
    <path class="path3" d="M636.537 432.042c6.324 6.324 6.324 12.644 0 18.964l-189.647 177.457c-7.223 6.318-13.998 6.318-20.32 0l-44.704-48.767c-6.32-7.225-6.32-13.998 0-20.32l189.649-177.455c7.223-6.322 13.996-5.87 20.322 1.356l44.7 48.765z"></path>
    <path class="path4" d="M478.044 727.349c6.316 6.324 5.865 12.642-1.356 18.967l-29.802 28.449c-7.223 6.322-13.998 6.322-20.318 0l-174.748-189.649c-6.322-6.322-6.322-12.644 0-18.964l31.156-28.449c6.322-6.322 12.642-6.322 18.964 0l176.103 189.647z"></path>
    <path class="path5" d="M769.292 438.815c6.32 6.324 6.32 12.644 0 18.964l-31.156 28.449c-6.326 6.32-12.65 6.32-18.967 0l-174.744-189.649c-6.324-6.322-6.324-12.642 0-18.967l29.802-28.447c7.221-6.322 13.994-6.322 20.318 0l174.746 189.649z"></path>
    <path class="path6" d="M834.314 377.856c6.32 7.223 5.868 13.998-1.356 20.318l-29.802 28.449c-6.326 6.31-12.648 5.857-18.962-1.356l-176.101-188.293c-6.308-7.223-5.855-13.998 1.354-20.32l29.802-28.447c6.32-6.32 12.64-5.87 18.964 1.356l176.101 188.293z"></path>
</symbol>
<symbol id="icon-8" viewBox="0 0 1024 1024">
    <title>events</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M187.879 477.954l46.395-23.007 10.592-267.35-40.348-1.589c-21.348-0.854-39.328 15.727-40.147 37.075l-8.55 215.427c-0.416 10.248 3.273 20.232 10.224 27.775 5.798 6.263 13.531 10.248 21.834 11.67z"></path>
    <path class="path3" d="M401.172 367.585l-42.732-45.021c-1.673-1.78-2.206-4.389-1.364-6.689 0.854-2.3 2.916-3.936 5.374-4.176l61.696-6.498c2.111-0.238 3.985-1.495 4.983-3.344l29.708-54.534c1.186-2.159 3.486-3.461 5.917-3.369 2.456 0.094 4.612 1.589 5.634 3.817l25.24 56.717c0.877 1.944 2.597 3.32 4.721 3.723l21.645 4.030 117.246-58.161 2.017-50.784-349.198-13.806-9.57 241.59 120.238-59.656c-0.178-1.397-0.594-2.773-1.554-3.84z"></path>
    <path class="path4" d="M727.884 219.998c11.645 0 22.792 2.417 32.971 6.642-6.357-11.362-18.17-19.333-32.139-19.902l-40.325-1.589-0.995 25.002 2.394-1.161c11.739-5.859 24.951-8.991 38.095-8.991z"></path>
    <path class="path5" d="M170.338 539.367c-9.181 4.555-16.177 12.618-19.452 22.272-3.273 9.701-2.525 20.328 1.993 29.508l112.849 227.381c6.699 13.595 20.423 21.467 34.632 21.467 5.788 0 11.635-1.305 17.148-4.053l48.189-23.865-147.159-296.595-48.2 23.886z"></path>
    <path class="path6" d="M875.352 516.098l-112.839-227.408c-6.689-13.591-20.472-21.465-34.681-21.465-5.716 0-11.622 1.282-17.148 4.055l-48.153 23.91 147.186 296.6 48.173-23.886c9.181-4.557 16.202-12.595 19.45-22.274 3.275-9.701 2.587-20.353-1.989-29.532z"></path>
    <path class="path7" d="M260.794 494.512l147.198 296.573 359.457-178.352-147.184-296.622-359.471 178.401zM631.128 623.266c-1.141 2.181-3.465 3.535-5.837 3.51l-72.37-1.661c-2.109-0.047-4.104 0.948-5.362 2.634l-42.41 58.587c-1.458 1.968-3.891 2.966-6.312 2.537-2.431-0.428-4.424-2.134-5.134-4.557l-20.709-69.31c-0.594-2.015-2.169-3.627-4.184-4.293l-68.837-22.202c-2.324-0.76-4.055-2.775-4.424-5.22-0.356-2.466 0.713-4.837 2.728-6.261l59.453-41.085c1.757-1.21 2.8-3.201 2.8-5.335l-0.166-72.323c0-2.468 1.374-4.721 3.592-5.81 2.183-1.092 4.805-0.854 6.748 0.639l57.522 43.882c1.681 1.28 3.887 1.683 5.906 0.995l68.788-22.485c2.327-0.76 4.862-0.119 6.572 1.612 1.706 1.755 2.324 4.364 1.518 6.666l-25.072 71.424 44.618 61.127c1.495 2.089 1.663 4.77 0.571 6.928z"></path>
</symbol>
<symbol id="icon-7" viewBox="0 0 1024 1024">
    <title>entertainment</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M406.194 415.187c-75.684-84.374-172.966-115.036-174.578-115.411-23.958-5.181-47.608 10.011-52.802 33.956-5.19 23.947 10.011 47.565 33.948 52.767 0 0 104.942 17.144 192.817 123.292 73.071 88.281 89.555 225.71 89.555 225.71l0.219 1.358c1.098 6.365 6.836 11.061 13.488 10.756 7.111-0.395 12.642-6.496 12.315-13.611 0-0.063 3.029-193.923-114.962-318.816z"></path>
    <path class="path3" d="M573.526 591.749c0 0-9.658-90.345 71.447-171.514 66.091-66.222 165.632-74.519 167.784-75.090 23.73-6.41 37.665-30.796 31.324-54.479-6.388-23.685-30.796-37.669-54.526-31.259 0 0-59.286 19.886-97.829 42.693-170.547 100.88-143.464 288.725-143.464 288.725 0.24 6.103 4.915 11.35 11.219 12.095 6.957 0.793 13.234-4.188 14.045-11.172z"></path>
    <path class="path4" d="M641.855 634.137c87.581-101.825 164.975-113.59 166.16-114.072 16.878-7.178 24.783-26.735 17.537-43.639-7.199-16.878-26.737-24.758-43.637-17.537 0 0-56.193 19.732-113.787 75.772-118.092 108.564-100.155 260.344-100.155 260.344 0.088 5.071 3.951 9.331 9.064 9.837 5.53 0.528 10.535-3.467 11.020-9.021-0.070-0.047 5.204-105.296 53.797-161.683z"></path>
    <path class="path5" d="M357.421 251.859l0.287 0.066c0 0 36.569 2.81 81.73 60.076 50.385 63.941 60.328 162.185 60.328 162.185 0.737 4.061 4.336 7.045 8.561 6.957 4.698-0.109 8.419-4.016 8.307-8.714 0 0 8.913-116.619-53.371-211.089-39.334-59.658-91.144-74.476-92.989-74.871-18.076-3.535-35.58 8.208-39.158 26.272-3.5 18.070 8.253 35.586 26.307 39.119z"></path>
    <path class="path6" d="M347.621 657.291c-58.444-24.408-109.826-21.797-111.714-21.51-18.184 2.787-30.675 19.778-27.92 37.974 2.787 18.219 19.788 30.683 37.997 27.92 0 0 56.949-10.779 110.584 9.153 77.832 29.016 103.229 124.457 103.229 124.457 0.834 2.851 3.643 4.827 6.705 4.477 3.434-0.416 5.904-3.488 5.542-6.957-0.045 0.043 4.927-118.706-124.422-175.514z"></path>
    <path class="path7" d="M800.596 677.091l-0.549-0.043c0 0-27.042-9.834-83.255 14.332-82.508 35.383-86.264 133.237-86.264 133.237-0.504 2.744 0.86 5.597 3.469 6.828 3.185 1.405 6.869 0.084 8.274-3.054 0 0 17.801-63.435 75.772-86.219 35.295-13.871 72.897 1.36 75.747 1.604 18.395 1.886 34.859-11.526 36.725-29.919 1.866-18.418-11.526-34.879-29.919-36.766z"></path>
    <path class="path8" d="M563.276 269.879c0.463 1.866 1.956 3.291 3.797 3.754 1.866 0.463 3.817-0.131 5.116-1.536l18.942-20.609 26.997-7.178c1.866-0.506 3.293-1.954 3.756-3.797 0.479-1.866-0.133-3.797-1.493-5.134l-20.613-18.878-7.176-27.042c-0.463-1.843-1.954-3.271-3.797-3.754-1.866-0.438-3.82 0.154-5.138 1.559l-18.962 20.609-27.001 7.178c-1.841 0.483-3.291 1.954-3.727 3.797-0.485 1.868 0.152 3.82 1.489 5.116l20.613 18.899 7.199 27.017z"></path>
    <path class="path9" d="M290.793 598.381c0.492 1.866 1.952 3.291 3.797 3.754 1.866 0.481 3.809-0.131 5.104-1.536l18.909-20.611 27.032-7.113c1.843-0.481 3.281-1.974 3.731-3.797 0.471-1.886-0.131-3.817-1.528-5.159l-20.609-18.919-7.143-27.019c-0.494-1.843-1.954-3.271-3.797-3.729-1.868-0.465-3.822 0.109-5.126 1.513l-18.909 20.632-27.032 7.133c-1.866 0.481-3.281 1.974-3.754 3.817-0.451 1.866 0.131 3.82 1.546 5.138l20.611 18.899 7.168 26.997z"></path>
    <path class="path10" d="M699.959 409.459c-0.508-1.866-1.978-3.271-3.822-3.754-1.841-0.438-3.797 0.131-5.136 1.559l-18.899 20.609-27.042 7.178c-1.845 0.483-3.271 1.954-3.731 3.797-0.463 1.866 0.129 3.82 1.534 5.114l20.634 18.876 7.115 27.042c0.481 1.843 1.974 3.291 3.817 3.731 1.866 0.483 3.82-0.109 5.136-1.516l18.899-20.609 27.044-7.176c1.841-0.506 3.291-1.954 3.729-3.797 0.483-1.866-0.129-3.82-1.559-5.136l-20.609-18.899-7.111-27.019z"></path>
    <path class="path11" d="M819.253 594.473l-7.133-27.042c-0.481-1.843-1.997-3.291-3.84-3.731-1.866-0.481-3.797 0.131-5.091 1.538l-18.901 20.609-27.042 7.133c-1.843 0.483-3.293 1.954-3.729 3.797-0.483 1.843 0.129 3.797 1.536 5.138l20.609 18.899 7.111 27.042c0.508 1.866 1.954 3.271 3.797 3.754 1.866 0.461 3.797-0.154 5.161-1.513l18.899-20.634 27.040-7.133c1.843-0.481 3.273-1.954 3.734-3.797 0.463-1.864-0.154-3.817-1.559-5.134l-20.591-18.926z"></path>
    <path class="path12" d="M222.288 255.021l7.166 27.042c0.494 1.843 1.954 3.291 3.797 3.731 1.866 0.481 3.83-0.131 5.126-1.536l18.907-20.609 27.032-7.158c1.823-0.526 3.26-1.952 3.711-3.817 0.451-1.868-0.154-3.797-1.569-5.116l-20.611-18.899-7.145-27.042c-0.494-1.843-1.954-3.271-3.797-3.731-1.866-0.438-3.832 0.152-5.104 1.556l-18.954 20.611-26.986 7.178c-1.843 0.481-3.303 1.952-3.754 3.797s0.156 3.817 1.548 5.093l20.634 18.899z"></path>
</symbol>
<symbol id="icon-6" viewBox="0 0 1024 1024">
    <title>coffee</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M262.633 820.163h91.711c1.278 8.016 7.893 14.24 16.259 14.24h208.486c8.407 0 14.995-6.191 16.271-14.24h91.711c15.514 0 28.080-12.536 28.080-28.049h-480.555c0 15.514 12.552 28.049 28.035 28.049z"></path>
    <path class="path3" d="M825.598 531.669c-23.376-18.944-56.281-19.249-77.959-16.851 0.608-15.118 0.973-30.57 0.973-46.631h-571.646c0 154.493 23.374 265.968 171.325 307.56h228.979c58.591-16.456 97.45-44.081 123.222-80.814 56.134-1.094 146.45-23.194 149.852-100.731 1.454-33.937-12.661-52.789-24.746-62.534zM724.021 650.582c10.744-27.625 17.117-58.714 20.642-92.867 15.176-2.488 41.316-4.067 54.522 6.681 2.431 1.974 9.99 8.135 9.11 28.021-1.761 40.161-51.61 53.643-84.273 58.165z"></path>
    <path class="path4" d="M409.842 446.482c0 0 108.802-7.983 58.939-99.727-40.042-73.648-30.904-116.849 20.326-155.89 0 0-167.807 42.744-69.945 175.016 35.897 57.62-9.32 80.601-9.32 80.601z"></path>
    <path class="path5" d="M483.17 439.134c0 0 87.173-18.364 39.725-88.463-17.213-30.417 6.529-41.257 6.529-41.257s-56.103 1.761-32.422 50c18.956 38.771 13.341 60.781-13.832 79.72z"></path>
</symbol>
<symbol id="icon-5" viewBox="0 0 1024 1024">
    <title>boutique</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M189.155 453.145c0 37.556 25.774 68.85 60.533 77.873v265.148h-40.356c-11.114 0-20.179 9.023-20.179 20.181 0 11.151 9.064 20.177 20.179 20.177h605.334c11.192 0 20.177-9.023 20.177-20.177s-8.985-20.181-20.177-20.181h-40.358v-265.148c34.763-9.023 60.535-40.317 60.535-77.873v-20.179h-645.687v20.179zM592.71 533.856c44.612 0 80.712-36.139 80.712-80.712 0 37.556 25.772 68.85 60.535 77.873v265.148h-302.668v-262.31c44.612 0 80.712-36.139 80.712-80.712 0 44.573 36.18 80.712 80.71 80.712zM411.111 531.018v265.148h-121.068v-265.148c34.761-9.023 60.533-40.317 60.533-77.873 0 37.556 25.778 68.85 60.535 77.873zM754.133 251.365h-484.266l-80.712 161.423h645.687l-80.71-161.423zM359.643 296.217l-40.356 80.712c-1.815 3.547-5.36 5.597-9.064 5.597-1.499 0-3.035-0.315-4.493-1.065-4.966-2.482-7.014-8.55-4.493-13.519l40.356-80.71c2.521-4.968 8.55-6.978 13.517-4.534 5.007 2.484 6.975 8.55 4.534 13.519zM440.353 296.217l-40.354 80.712c-1.815 3.547-5.362 5.597-9.066 5.597-1.497 0-3.033-0.315-4.493-1.065-4.964-2.482-7.014-8.55-4.493-13.519l40.356-80.71c2.523-4.968 8.591-6.978 13.519-4.534 5.005 2.484 6.975 8.55 4.532 13.519zM522.090 372.433c0 5.597-4.493 10.088-10.090 10.088-5.556 0-10.088-4.493-10.088-10.088v-80.712c0-5.597 4.532-10.088 10.088-10.088 5.595 0 10.090 4.493 10.090 10.088v80.712zM637.954 381.262c-1.577 0.868-3.232 1.262-4.889 1.262-3.547 0-7.014-1.89-8.827-5.243l-44.138-80.71c-2.683-4.889-0.87-11.035 4.016-13.677 4.813-2.681 11.039-0.946 13.715 3.979l44.141 80.712c2.601 4.887 0.868 11.037-4.018 13.677zM718.27 381.458c-1.419 0.75-2.916 1.065-4.493 1.065-3.703 0-7.25-2.048-8.987-5.597l-40.354-80.712c-2.519-4.966-0.471-11.035 4.493-13.517 4.887-2.482 11.033-0.473 13.558 4.53l40.354 80.712c2.447 4.966 0.473 11.037-4.571 13.519zM360.665 678.175v-46.502c-5.913-3.547-10.088-9.697-10.088-17.105 0-11.151 9.066-20.181 20.179-20.181 11.192 0 20.179 9.028 20.179 20.181 0 7.408-4.139 13.556-10.088 17.105v46.502c5.949 3.547 10.088 9.697 10.088 17.107 0 11.151-8.985 20.179-20.179 20.179-11.114 0-20.179-9.026-20.179-20.179 0-7.412 4.18-13.56 10.088-17.107zM269.867 211.012c0-11.153 9.062-20.179 20.177-20.179h443.912c11.192 0 20.179 9.026 20.179 20.179s-8.987 20.177-20.179 20.177h-443.912c-11.114 0-20.177-9.023-20.177-20.177zM542.818 641.876l-14.264-14.266 57.063-57.063 14.266 14.266-57.065 57.063zM542.818 698.939l-14.264-14.262 114.131-114.133 14.266 14.266-114.133 114.129zM642.685 627.61l14.266 14.27-57.065 57.061-14.268-14.264 57.068-57.068z"></path>
</symbol>
<symbol id="icon-4" viewBox="0 0 1024 1024">
    <title>auto</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M935.215 382.161h-64.856c-4.938 0-9.685 1.911-13.253 5.327l-13.844 13.263c-23.339-53.998-56.816-107.393-102.035-162.677-24.445-29.87-60.592-47-99.185-47h-259.656c-38.599 0-74.746 17.132-99.176 47.002-46.647 57.020-79.46 109.132-102.244 162.484l-13.64-13.072c-3.566-3.416-8.315-5.327-13.255-5.327h-64.852c-10.58 0-19.155 8.577-19.155 19.157v44.339c0 10.113 7.86 18.477 17.951 19.116l66.66 4.2c-10.072 29.432-17.936 73.288-17.936 135.139 0 53.668 10.719 88.945 29.374 111.776v103.32c0 8.86 7.182 16.040 16.042 16.040h73.787c8.864 0 16.048-7.18 16.048-16.040v-64.16h480.453v64.16c0 8.86 7.184 16.040 16.044 16.040h73.785c8.86 0 16.044-7.18 16.044-16.040v-103.32c18.651-22.831 29.379-58.108 29.379-111.776 0-61.852-7.866-105.708-17.938-135.139l66.662-4.2c10.088-0.639 17.949-9.003 17.949-19.116v-44.339c0-10.58-8.573-19.157-19.153-19.157zM337.957 282.86c10.949-13.382 27.144-21.060 44.429-21.060h259.658c17.287 0 33.489 7.678 44.435 21.060 31.633 38.672 56.619 75.682 75.926 112.548l-500.822 0.094c18.887-36.049 44.012-73.089 76.374-112.642zM283.378 676.588c-36.727 0-66.497-11.995-66.497-41.095 0-29.096 10.801-52.693 47.526-52.693s85.463 23.595 85.463 52.693c0 29.1-29.772 41.095-66.492 41.095zM581.921 670.523h-139.403c-21.017 0-38.113-17.097-38.113-38.111 0-5.892 4.78-10.672 10.678-10.672h194.279c5.896 0 10.672 4.78 10.672 10.672-0.002 21.017-17.099 38.111-38.113 38.111zM741.057 676.588c-36.725 0-66.497-11.995-66.497-41.095 0-29.096 48.744-52.693 85.461-52.693 36.727 0 47.528 23.595 47.528 52.693 0.002 29.1-29.766 41.095-66.492 41.095z"></path>
</symbol>
<symbol id="icon-3" viewBox="0 0 1024 1024">
    <title>attraction</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M738.464 557.185c7.864 3.934 14.008 3.686 18.432-0.733 4.424-4.428 2.214-8.602-6.633-12.536l-123.869-57.512c-7.864-3.932-16.712-4.424-26.544-1.475l-42.764 13.271c-9.834 2.949-17.451 4.424-22.856 4.424-5.409 0-8.112-4.915-8.112-14.748v-134.187c0-8.849 4.915-13.273 14.746-13.273h319.998c9.83 0 14.746-4.913 14.746-14.746v-45.715c0-8.847-4.428-14.746-13.273-17.695l-337.693-97.325c-8.843-2.949-18.184-2.949-28.017 0l-333.267 97.325c-8.847 2.949-13.271 8.847-13.271 17.695v45.715c0 9.83 4.913 14.746 14.746 14.746h315.572c9.83 0 14.746 4.424 14.746 13.273v134.189c0 9.832-4.913 14.748-14.746 14.748h-5.9c-8.847 0-16.71-3.441-23.595-10.322l-76.679-72.258c-6.881-6.881-14.746-10.322-23.593-10.322h-35.391c-9.83 0-16.957-3.197-21.381-9.587s-10.813-9.587-19.171-9.587c-8.358 0-9.585 3.443-3.686 10.324v1.475c4.915 7.866 4.915 15.731 0 23.595l-38.341 58.984c-4.915 7.864-3.932 15.237 2.949 22.12l2.949 1.473c6.883 6.885 14.746 7.864 23.595 2.951l39.815-20.646c8.847-4.915 15.729-3.439 20.646 4.424l45.713 69.308c4.913 7.864 3.441 14.748-4.424 20.644l-19.171 17.697c-7.864 5.9-10.813 13.271-8.847 22.12l26.542 115.020c1.966 9.832 7.864 13.271 17.697 10.324l17.697-4.424c9.83-1.964 13.765-7.373 11.796-16.22l-19.169-78.156c-1.962-9.832 1.968-15.729 11.796-17.697l44.239-11.801c9.83-2.945 19.171-4.42 28.019-4.42h5.9c9.83 0 14.746 4.915 14.746 14.748v137.136c0 9.837-4.913 14.748-14.746 14.748h-315.576c-9.83 0-14.746 4.424-14.746 13.271v45.711c0 9.832 4.913 14.748 14.746 14.748h690.129c9.832 0 14.744-4.915 14.744-14.748v-45.711c0-8.847-4.911-13.271-14.744-13.271h-314.098c-9.83 0-14.746-4.424-14.746-13.271v-138.613c0-9.832 4.915-14.748 14.746-14.748h16.222c9.832 0 19.171 1.477 28.021 4.42l45.711 11.801c8.847 1.968 12.29 7.864 10.324 17.697l-17.695 78.156c-1.966 8.847 1.47 14.256 10.318 16.22l19.169 4.424c8.847 2.947 14.258-0.492 16.22-10.324l26.546-115.020c1.946-8.847-0.508-16.22-7.377-22.12-6.887-5.9-10.82-13.761-11.794-23.593l-1.475-39.819c0-3.93 0.983-6.631 2.949-8.108 1.962-1.473 4.911-1.718 8.845-0.737l51.616 26.542z"></path>
</symbol>
<symbol id="icon-2" viewBox="0 0 1024 1024">
    <title>app</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M562.903 841.65c-9.953-17.5-15.262-22.942-17.844-25.561-1.446-1.446-3.342-3.41-4.925-6.099-12.196-10.197-17.637-27.251-16.71-40.546 0.276-4.166 1.38-7.856 2.824-11.336h-255.375v-539.242h358.658v402.547c0.102 0.24 0.137 0.311 0.24 0.551 6.099 12.474 14.158 28.836 20.359 41.064 2.859-1.892 6.062-3.686 9.578-5.028 3.238-1.239 7.578-2.482 12.642-2.826v-475.648c-0.070-31.488-25.598-57.119-57.188-57.119h-329.994c-31.556 0-57.084 25.631-57.084 57.119v670.185c0 31.59 25.528 57.151 57.084 57.151h330.064c12.126 0 23.288-3.791 32.52-10.267-13.881-5.546-29.42-13.437-45.195-25.010-30.763-14.158-37.55-24.494-39.653-29.936zM577.579 158.235c8.063 0 14.641 6.545 14.641 14.572 0 8.133-6.543 14.574-14.641 14.574-8.063 0-14.606-6.441-14.606-14.574 0.002-8.028 6.545-14.572 14.606-14.572zM373.707 163.781h153.025v16.675h-153.025v-16.675zM519.877 845.99h-139.383v-42.887h139.35l0.033 42.887zM324.202 281.428h99.283v108.069h-99.283v-108.069zM429.928 402.381c3.549 0 6.478-2.929 6.478-6.478v-120.953c0-3.547-2.929-6.476-6.478-6.476h-112.237c-3.547 0-6.478 2.929-6.478 6.476v120.99c0 3.547 2.929 6.476 6.478 6.476l112.237-0.035zM317.692 274.95h112.237v120.99h-112.237v-120.99zM601.729 459.258c0 9.576-7.717 17.258-17.293 17.258h-264.989c-9.544 0-17.293-7.682-17.293-17.258 0-9.544 7.717-17.293 17.293-17.293h265.021c9.546 0 17.261 7.752 17.261 17.293zM551.985 549.243h-234.293c-9.542 0-17.293-7.721-17.293-17.295 0-9.511 7.717-17.258 17.293-17.258h265.023c9.542 0 17.291 7.717 17.291 17.258s-7.75 17.295-17.291 17.295h-3.824c-7.891-3.103-16.708-4.135-25.010-0.932-0.623 0.207-1.243 0.655-1.896 0.932zM502.411 588.927c0.621 4.067 1.583 8.614 3.029 13.572 2.687 7.444 5.204 14.195 7.75 20.949h-195.5c-9.542 0-17.293-7.719-17.293-17.293 0-9.544 7.717-17.261 17.293-17.261l184.721 0.033zM729.434 904.52c0 0 5.1-12.847-18.153-18.395 0 0-42.408 1.034-88.089-26.421 0 0-31.418-10.574-34.656-18.67-21.842-31.181-26.837-27.46-27.869-33.073-21.361-9.404-27.009-57.946 14.332-35.76 0.551-0.24 27.972 21.463 28.111 20.91 0 0 22.116 18.569 33.864 19.259 15.399-8.577-29.489-75.618-29.936-81.474 0 0-24.531-41.202-64.836-124.432-20.013-49.746 13.679-40.892 27.113-24.459 3.443-1.104 67.969 110.103 72.274 109.38 0 0 18.223-38.55 50.434-12.677 0 0 21.187-32.764 49.885-5.097 0 0 42.234-17.263 57.702 21.496 0 0 43.956 65.042 43.338 126.601l4.477 23.941-117.991 58.872z"></path>
</symbol>
<symbol id="icon-1" viewBox="0 0 1024 1024">
    <title>restaurant</title>
    <path class="path1" d="M1024 512c0 282.77-229.23 512-512 512s-512-229.23-512-512c0-282.77 229.23-512 512-512s512 229.23 512 512z"></path>
    <path class="path2" d="M681.013 119.413c-47.448 0-87.022 36.712-90.393 84.044l-24.199 337.996c-1.067 14.752 4.016 29.348 14.107 40.151 10.060 10.803 24.148 17.052 38.914 17.052h1.407l-8.262 264.661c-0.356 11.307 3.893 21.979 11.786 30.073 7.875 8.159 18.711 12.397 30.022 12.397h34.714c23.099 0 42.369-18.188 42.369-41.316v-694.882c-0.002-27.703-22.727-50.174-50.465-50.174z"></path>
    <path class="path3" d="M481.366 119.97h-3.531c-8.45 0-14.936 6.334-14.936 14.801v148.949c0 13.226-11.074 24.029-24.275 24.029h-3.555c-13.189 0-24.375-10.803-24.375-24.029v-148.949c0-8.45-6.365-14.801-14.825-14.801h-3.59c-8.466 0-15.19 6.334-15.19 14.801v148.949c0 13.226-10.822 24.029-24.037 24.029h-3.539c-13.193 0-23.421-10.803-23.421-24.029v-148.949c0-8.45-7.34-14.801-15.8-14.801h-3.555c-8.442 0-15.469 6.334-15.469 14.801v225.305c0 27.705 22.598 49.631 50.301 49.631h6.699l-14.15 453.489c-0.365 11.327 3.879 22.049 11.77 30.175 7.875 8.129 18.729 12.444 30.075 12.444h33.36c11.303 0 22.157-4.315 30.048-12.444 7.893-8.145 12.124-18.985 11.796-30.312l-14.15-453.37h9.533c27.73 0 49.938-21.946 49.938-49.633v-225.303c-0.035-8.464-6.623-14.782-15.122-14.782z"></path>
</symbol>
</defs>
</svg>
<style>
@font-face {
    font-family: 'icomoon';
    src:url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.eot');
    src:url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.eot?#iefix') format('embedded-opentype'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.woff') format('woff'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.ttf') format('truetype'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.svg#icomoon') format('svg');
    font-weight: normal;
    font-style: normal;
}

body{
   /* margin-top:0px !important;*/
}
/* the search bar style*/
.sb-search {
    position: relative;
    margin-top: 10px;
   width: 0%;
    min-width: 40px;
    height: 40px;
    float: right;
    overflow: hidden;
 
    -webkit-transition: width 0.3s;
    -moz-transition: width 0.3s;
    transition: width 0.3s;
 
    -webkit-backface-visibility: hidden;
}
.sb-search-input {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    outline: none;
    background: #fff;
    width: 97%;
    height: 38px;
    margin: 0;
    z-index: 10;
    padding: 0px 0px 0px 2% !important;
    font-family: inherit;
    font-size: 16px;
    color: #2c3e50;
}
 
input[type="search"].sb-search-input {
    -webkit-appearance: none;
    -webkit-border-radius: 0px;
}
.sb-search-input::-webkit-input-placeholder {
    color: #cccccc;
}
 
.sb-search-input:-moz-placeholder {
    color: #cccccc;
}
 
.sb-search-input::-moz-placeholder {
    color: #cccccc;
}
 
.sb-search-input:-ms-input-placeholder {
    color: #cccccc;
}
.sb-icon-search,
.sb-search-submit  {
    width: 40px;
    height: 40px;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
    padding: 0;
    margin: 0;
    line-height: 43px;
    text-align: center;
    cursor: pointer;
}
.sb-search-submit {
    background: #fff; /* IE needs this */
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; /* IE 8 */
    filter: alpha(opacity=0); /* IE 5-7 */
    opacity: 0;
    color: transparent;
    border: none;
    outline: none;
    z-index: -1;
}
.sb-icon-search {
    color: #cccccc;
   background:#fff;
    z-index: 90;
    font-size: 17px;
    font-family: 'icomoon';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
}
 
.sb-icon-search:before {
    content: "\e000";
}

.sb-search.sb-search-open,
.no-js .sb-search {
    width: 100%;
}
.sb-search.sb-search-open .sb-icon-search,
.no-js .sb-search .sb-icon-search {
    background: #00b8ba;
    color: #fff;
    z-index: 11;
}
.sb-search.sb-search-open .sb-search-submit,
.no-js .sb-search .sb-search-submit {
    z-index: 90;
}
</style>
<header style="padding:0px !important;border:none;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
          
            <div id="sb-search" class="sb-search">


                <form name='search' action="<?php  echo $this->url('search','search_all') ?>" method="POST">
                       
                            <input class="sb-search-input" id="search" name="subject" placeholder="Enter your search term..." value="" type="search">
                           <input class="sb-search-submit" type="submit" value="">
                           
                            <span class="sb-icon-search"></span>
                </form> 
            </div>

           
            </div>
        </div>
    </div>
</header>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
<?php
$pageTitle = "Excel Export: Enterprise Grade Feature of our Datagrid";
$pageDescription = "Enterprise feature of ag-Grid supporting Angular, React, Javascript and more. One such feature is Excel Export. Export in native Excel Format which will maintain the column widths and also allow exporting of styles. Version 20 is available for download now, take it for a free two month trial.";
$pageKeyboards = "JavaScript Grid Excel";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

    <h1 class="heading-enterprise">JavaScript Grid Excel</h1>
    <article>

        <p class="lead">
            Excel Export allows exporting ag-Grid data to Excel using Open XML format (xlsx) or Excel's own XML format.
            The export can be initiated with with an API call or by using the right-click context menu on the Grid.<br/>
        </p>

        <note>
            This page covers Excel-specific features such as styling. For information on how to control what data is included in the export
            and to format/transform the data as it is exported, see the <a href="../javascript-grid-export/">Export documentation</a>.
        </note>

        <? enterprise_feature("Excel Export"); ?>

        <p>
            Using this format allows for rich Excel files to be created with the following:
        </p>

        <ol class="content">
            <li>The column width from your grid is exported to Excel, so the columns in Excel will have the same width as your web application</li>
            <li>You can specify Excel styles (colors, fonts, borders etc) to be included in the Excel file.</li>
            <li>The data types of your columns are passed to Excel as part of the export so that if you can to work with the data within Excel in the correct format.</li>
            <li>The cells of the column header groups are merged in the same manner as the group headers in ag-Grid.</li>
        </ol>
        
        <h2>API</h2>

        <ul class="content">
            <li><code>gridOptions.suppressExcelExport</code>: set this Grid Property true to disable Excel export
            <li>
                <code>exportDataAsExcel(params)</code>: download an Excel file to the user's computer.
            </li>
            <li>
                <code>getDataAsExcel(params)</code>: Returns Excel file as an XML string. This forces
                <code>exportMode</code> to <strong>xml</strong>.
            </li>
        </ul>

        <p>
            The params object can contain all the <a href="../javascript-grid-export/">common export options</a>, as
            well as these Excel-specific options:
        </p>

        <?php
            include_once './excelProperties.php';
            printPropertiesTable($excelProperties);    
        ?>

        <h2>Defining styles</h2>

        <p>
            The main reason to export to Excel instead of CSV is so that the look and feel remain as consistent as possible with your ag-Grid application. In order to
            simplify the configuration the Excel Export reuses the <a href="../javascript-grid-cell-styles/#cellClassRules">cellClassRules</a>
            and the <a href="../javascript-grid-cell-styles/#cellClass">cellClass</a> from the column definition.
            Whatever resultant class is applicable to the cell then is expected to be provided as an Excel Style to the
            ExcelStyles property in the <a href="../javascript-grid-properties/">gridOptions</a>.
        </p>

        <p>
            An Excel style object has the following properties:
        </p>

        <ul class="content">
            <li><code>id</code> (mandatory): The id of the style, this has to be a unique string and has to match the name of the style from the <a href="../javascript-grid-cell-styles/#cellClassRules">cellClassRules</a></li>
            <li><code>alignment</code> (optional): Vertical and horizontal alignment:
                <ul class="content">
                    <li>horizontal: String one of Automatic, Left, Center, Right, Fill, Justify, CenterAcrossSelection, Distributed, and JustifyDistributed</li>
                    <li>indent: Number of indents</li>
                    <li>readingOrder: String one of RightToLeft, LeftToRight, and Context</li>
                    <li>rotate: Number. Specifies the rotation of the text within the cell. Values range between 0 and 180.</li>
                    <li>shrinkToFit: Boolean. True means that the text size should be shrunk so that all of the text fits within the cell. False means that the font within the cell should behave normally</li>
                    <li>vertical: String one of Automatic, Top, Bottom, Center, Justify, Distributed, and JustifyDistributed</li>
                    <li>wrapText: Boolean. Specifies whether the text in this cell should wrap at the cell boundary.
                        False means that text either spills or gets truncated at the cell boundary (depending on whether the adjacent cell(s) have content). </li>
                </ul>
            </li>
            <li><code>borders</code> (optional): All the 4 borders must be specified (explained in next section): 
                <ul class="content">
                    <li>borderBottom</li>
                    <li>borderLeft</li>
                    <li>borderTop</li>
                    <li>borderRight</li>
                </ul>
            </li>
            <li><code>font</code> (optional):  The color must be declared: 
                <ul class="content">
                    <li>bold. Boolean</li>
                    <li>color. A color in hexadecimal format</li>
                    <li>fontName. String</li>
                    <li>italic. Boolean</li>
                    <li>outline. Boolean</li>
                    <li>shadow. Boolean</li>
                    <li>size. Number. Size of the font in points</li>
                    <li>strikeThrough. Boolean.</li>
                    <li>underline. One of None, Subscript, and Superscript.</li>
                    <li>charSet. Number. Win32-dependent character set value.</li>
                    <li>family. String. Win32-dependent font family. One of Automatic, Decorative, Modern, Roman, Script, and Swiss</li>
                </ul>
            </li>
            <li><code>interior</code> (optional): The color and pattern must be declared:
                <ul class="content">
                    <li><code>color</code>: A color in hexadecimal format</li>
                    <li><code>pattern</code>: One of the following strings: None, Solid, Gray75, Gray50, Gray25, Gray125, Gray0625, HorzStripe, VertStripe, ReverseDiagStripe, DiagStripe, DiagCross, ThickDiagCross, ThinHorzStripe, ThinVertStripe, ThinReverseDiagStripe, ThinDiagStripe, ThinHorzCross, and ThinDiagCross</li>
                    <li><code>patternColor</code>: A color in hexadecimal format</li>
                </ul>
            </li>
            <li><code>numberFormat</code> (optional): A javascript object with one property called format, this is any valid Excel format like: #,##0.00 (This formatting is used in the example below in the age column)</li>
            <li><code>protection</code> (optional): A javascript object with the following properties:
                <ul class="content">
                    <li><code>protected</code>: Boolean. This attribute indicates whether or not this cell is protected.
                        When the worksheet is unprotected, cell-level protection has no effect. When a cell is protected,
                        it will not allow the user to enter information into it. Note that in Excel, the default for cells
                        with no protection style is to be protected, so you must explicitly disable protection if it is
                        not desired.
                    </li>
                    <li><code>hideFormula</code>: Boolean. This attribute indicates whether or not this cell's formula should be hidden
                    when worksheet protection is enabled.
                    </li>
                </ul>
            </li>
            <li><code>dataType</code> (optional): One of (string, number, boolean, dateTime, error). In most cases this is not necessary since this value is
                guessed based in weather the cell content is numeric or not. This is helpful if you want to fix the type of the
                cell. ie. If your cell content is 003, this cell will be default be interpreted as numeric, and in Excel, it will
                show up as 3. But if you want to keep your original formatting, you can do so by setting this property to string.
            </li>
        </ul>

        <h2>Excel borders</h2>

        <p>
            The borderBottom, borderLeft, borderTop, borderRight properties are objects composed of the following mandatory properties:
        </p>

        <ul class="content">
            <li><code>lineStyle</code>: One of the following strings: "None", "Continuous", "Dash", "Dot", "DashDot", "DashDotDot", "SlantDashDot", and "Double".</li>
            <li><code>weight</code>: A number representing the thickness of the border in pixels.
                <ol start="0">
                    <li>hair</li>
                    <li>thin</li>
                    <li>medium</li>
                    <li>thick</li>
                </ol>
            </li>
            <p> Note: for "Continuous" lines, all 4 weights are valid. "Dash", "DashDot" and "DashDotDot" accept
                weight 0 (default) and weight 2 (medium). Weight is not used for the other line styles.
            <li><code>color</code>: A color in hexadecimal format.</code></li>
        </ul>

        <h2>Excel Style Definition Example</h2>

<snippet>
var columnDef = {
    ...,
    // The same cellClassRules and cellClass can be used for CSS and Excel
    cellClassRules: {
        greenBackground: function(params) { return params.value &lt; 23}
    },
    cellClass: 'redFont'
};

// In this example we can see how we merge the styles in Excel.
// Everyone less than 23 will have a green background, and a light green color font (#e0ffc1)
// also because redFont is set in cellClass, it will always be applied

var gridOptions = {
    ...,
    ExcelStyles: [
        // The base style, red font.
        {
            id: "redFont",
            interior: {
                color: "#FF0000", pattern: 'Solid'
            }
        },
        // The cellClassStyle: background is green and font color is light green,
        // note that since this excel style it's defined after redFont
        // it will override the red font color obtained through cellClass:'red'
        {
            id: "greenBackground",
            alignment: {
                horizontal: 'Right', vertical: 'Bottom'
            },
            borders: {
                borderBottom: {
                    color: "#000000", lineStyle: 'Continuous', weight: 1
                },
                borderLeft: {
                    color: "#000000", lineStyle: 'Continuous', weight: 1
                },
                borderRight: {
                    color: "#000000", lineStyle: 'Continuous', weight: 1
                },
                borderTop: {
                    color: "#000000", lineStyle: 'Continuous', weight: 1
                }
            },
            font: { color: "#e0ffc1"},
            interior: {
                color: "#008000", pattern: 'Solid'
            }
        }

    ]
};
</snippet>

    <h2>Resolving Excel Styles</h2>

        <p>
            All the defined classes from <a href="../javascript-grid-cell-styles/#cellClass">cellClass</a> and all the classes resulting from evaluating
            the <a href="../javascript-grid-cell-styles/#cellClassRules">cellClassRules</a>
            are applied to each cell when exporting to Excel.
            Normally these styles map to CSS classes when the grid is doing normal rendering. In Excel Export, the styles are mapped against the Excel styles
            that you have provided. If more than one Excel style is found, the results are merged (similar to how CSS classes
            are merged by the browser when multiple classes are applied).
        </p>

        <p>
            Headers are a special case, headers are exported to Excel as normal rows, so in order to allow you to style them
            you can provide an ExcelStyle with id and name "header". If you do so, the headers
        </p>

        <h2>Example - Export With Styles </h2>

        <ul class="content">
            <li>Cells with only one style will be exported to Excel, as you can see in the Country and Gold columns</li>
            <li>Styles can be combined it a similar fashion than CSS, this can be seen in the column age where athletes less than 20 years old get two styles applied (greenBackground and redFont)</li>
            <li>A default columnDef containing cellClassRules can be specified and it will be exported to Excel.
                You can see this is in the styling of the oddRows of the grid (boldBorders)</li>
            <li>Its possible to export borders as specified in the gold column (boldBorders)</li>
            <li>If a cell has an style but there isn't an associated Excel Style defined, the style for that cell won't
                get exported. This is the case in this example of the year column which has the style notInExcel, but since
                it hasn't been specified in the gridOptions, the column then gets exported without formatting.</li>
            <li>Note that there is an Excel Style with name and id header that gets automatically applied to the ag-Grid headers when exported to Excel</li>
            <li>As you can see in the column "Group", the Excel styles can be combined into cellClassRules and cellClass</li>
            <li>Note that there are specific to Excel styles applied, the age column has a number formatting style applied
                and the group column uses italic and bold font</li>
            <li>
                The silver column has a style with <code>dataType=string</code>. This forces this column to be rendered as text in
                Excel even though all of their cells are numeric
            </li>
        </ul>

        <?= example('Excel Export', 'excel-export-with-styles', 'generated', array("enterprise" => 1, "processVue" => true)) ?>

        <h2>Example - Styling Row Groups</h2>

        <p>By default, row groups are exported with the names of each node in the hierarchy combined together, like <span style="white-space: nowrap">"-> Parent -> Child"</span>.
            If you prefer to use indentation to indicate hierarchy like the Grid user interface does, you can achieve this by combining
            <code>colDef.cellClass</code> and <code>processRowGroupCallback</code>:</p>

        <?= example('Styling Row Groups', 'styling-row-groups', 'generated', array("enterprise" => 1, "processVue" => true, "exampleHeight" => 300)) ?>
        
        <h2>Dealing With Errors In Excel</h2>

        <p>
            If you get an error when opening the Excel file, the most likely reason is that there is an error in the definition of the styles.
            If that is the case, we recommend that you remove all style definitions from your configuration and add them one-by-one until
            you find the definition that is causing the error.
        </p>

        <p>
            Some of the most likely errors you can encounter when exporting to Excel are:
        </p>

        <ul class="content">
            <li>Not specifying all the attributes of an Excel Style property. If you specify the interior for an
                Excel style and don't provide a pattern, just color, Excel will fail to open the spreadsheet</li>
            <li>Using invalid characters in attributes, we recommend you not to use special characters.</li>
            <li>Not specifying the style associated to a cell, if a cell has an style that is not passed as part of the
                grid options, Excel won't fail opening the spreadsheet but the column won't be formatted.</li>
            <li>Specifying an invalid enumerated property. It is also important to realise that Excel is case sensitive,
            so Solid is a valid pattern, but SOLID or solid are not</li>
        </ul>

        <h2>Example - Data types</h2> 

        <p>
            The following example demonstrates how to use other data types for your export. Note that:
        </p>

        <ul class="content">
            <li>Boolean works off using 1 for true</li>
            <li>The date time format for excel follows this format yyyy-mm-ddThh:MM:ss.mmm: </li>
            <li>If you try to pass data that is not compatible with the underlying data type Excel will throw an error</li>
            <li>When using <code>dataType: 'dateTime'</code> Excel doesn't format the resultant value, in this example
            it shows 39923. You need to add the formatting inside Excel</li>
        </ul>

        <?= example('Excel Data Types', 'excel-data-types', 'generated', array("enterprise" => 1, "processVue" => true, "exampleHeight" => 200)) ?>

    </article>

<?php include '../documentation-main/documentation_footer.php';?>
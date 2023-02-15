<!DOCTYPE html>
<html>

<head>
    <title>Binary Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            --header-bg: #333;
            --header-color: #fff;
            --content-bg: #f5f5f5;
            --content-color: #333;
        }

        body.dark-mode {
            --header-bg: #222;
            --header-color: #fff;
            --content-bg: #333;
            --content-color: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--header-bg);
            color: var(--header-color);
            padding: 10px;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .converter {
            flex: 1;
            max-width: 300px;
            margin: 20px;
            padding: 20px;
            background-color: var(--content-bg);
            color: var(--content-color);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input[type="radio"] {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        #theme-toggle {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 34px;
            transition: background-color 0.2s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: #fff;
            border-radius: 50%;
            transition: transform 0.2s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        @media (max-width: 600px) {
            .converter {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Binary Converter</h1>
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider"></span>
        </label>
    </header>
    <main>
        <div class="converter">
            <h2>Convert From</h2>
            <label for="from-binary">Binary</label>
            <input type="radio" name="from" value="binary" id="from-binary" checked>
            <label for="from-decimal">Decimal</label>
            <input type="radio" name="from" value="decimal" id="from-decimal">
            <label for="from-hexadecimal">Hexadecimal</label>
            <input type="radio" name="from" value="hexadecimal" id="from-hexadecimal">
            <br>
            <input type="text" id="input" placeholder="Enter a value">
        </div>
        <div class="converter">
            <h2>Convert To</h2>
            <label for="to-binary">Binary</label>
            <input type="radio" name="to" value="binary" id="to-binary">
            <label for="to-decimal">Decimal</label>
            <input type="radio" name="to" value="decimal" id="to-decimal" checked>
            <label for="to-hexadecimal">Hexadecimal</label>
            <input type="radio" name="to" value="hexadecimal" id="to-hexadecimal">
            <br>
            <input type="text" id="output" readonly>
        </div>
    </main>
    <script>
        const input = document.getElementById("input");
        const output = document.getElementById("output");
        const fromBinary = document.getElementById("from-binary");
        const fromDecimal = document.getElementById("from-decimal");
        const fromHexadecimal = document.getElementById("from-hexadecimal");
        const toBinary = document.getElementById("to-binary");
        const toDecimal = document.getElementById("to-decimal");
        const toHexadecimal = document.getElementById("to-hexadecimal");
        const themeToggle = document.getElementById("theme-toggle");

        themeToggle.addEventListener("change", () => {
            document.body.classList.toggle("dark-mode");
        });

        function convert() {
            const inputValue = input.value.trim();
            let inputType, outputType;

            if (fromBinary.checked) {
                inputType = "binary";
            } else if (fromDecimal.checked) {
                inputType = "decimal";
            } else if (fromHexadecimal.checked) {
                inputType = "hexadecimal";
            }

            if (toBinary.checked) {
                outputType = "binary";
            } else if (toDecimal.checked) {
                outputType = "decimal";
            } else if (toHexadecimal.checked) {
                outputType = "hexadecimal";
            }

            let decimalValue = 0;

            switch (inputType) {
                case "binary":
                    decimalValue = parseInt(inputValue, 2);
                    break;
                case "decimal":
                    decimalValue = parseInt(inputValue, 10);
                    break;
                case "hexadecimal":
                    decimalValue = parseInt(inputValue, 16);
                    break;
            }

            let outputValue = "";

            switch (outputType) {
                case "binary":
                    outputValue = decimalValue.toString(2);
                    break;
                case "decimal":
                    outputValue = decimalValue.toString(10);
                    break;
                case "hexadecimal":
                    outputValue = decimalValue.toString(16).toUpperCase();
                    break;
            }

            output.value = outputValue;
        }

        // convert on input change
        input.addEventListener("input", convert);

        // convert on radio button change
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach((radioButton) => {
            radioButton.addEventListener("change", convert);
        });
    </script>
</body>

</html>
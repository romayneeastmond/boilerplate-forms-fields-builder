<?php
    class GeneratorModel
    {
        /**
         * Returns a string of Angular console commands
         *
         * @return string
         */
        public static function generateAngularConsoleCommands($moduleName)
        {
            $moduleName = trim($moduleName);
            
            if (empty($moduleName))
            {
                return null;
            }
            
            $template = "\nng g module " .strtolower($moduleName) . " & \n";
            $template .= "cd " .strtolower($moduleName) . " & \n";
            $template .= "ng g component --skipTests=true --style=scss " .strtolower($moduleName) . " & \n";
            $template .= "ng g component --skipTests=true --style=scss " .strtolower($moduleName) . "-add & \n";
            $template .= "ng g component --skipTests=true --style=scss " .strtolower($moduleName) . "-view";
    
            return htmlentities($template);		
        }

        /**
         * Returns a string of a model formatted for Angular
         *
         * @return string
         */        
        public static function generateAngularModel($angularModelStructure, $moduleName)
        {
            if (!empty($angularModelStructure))
            {
                $className = "formModel";
                
                if (isset($moduleName))
                {
                    $className = ucfirst($moduleName) ."Model";
                }			
                
                $template = "\nexport class " .$className . " {\n";
                
                foreach($angularModelStructure as $value)
                    $template .= "\t" . $value .": string;\n";			

                $template .= "}";
    
                return htmlentities($template);			
            }
    
            return null;		
        }

        /**
         * Returns a string of an Angular module router
         *
         * @return string
         */
        public static function generateAngularRouter($moduleName)
        {
            $moduleName = trim($moduleName);
            
            if (empty($moduleName))
            {
                return null;
            }
            
            $template = "\nimport { NgModule } from '@angular/core';\n";
            $template .= "import { Routes, RouterModule } from '@angular/router';\n";
            $template .= "import { " .ucfirst(strtolower($moduleName)). "Component } from './" .strtolower($moduleName) . "/" .strtolower($moduleName) . ".component';\n";
            $template .= "import { " .ucfirst(strtolower($moduleName)). "AddComponent } from './" .strtolower($moduleName) . "/" .strtolower($moduleName) . "-add/" .strtolower($moduleName) . "-add.component';\n";
            $template .= "import { " .ucfirst(strtolower($moduleName)). "ViewComponent } from './" .strtolower($moduleName) . "/" .strtolower($moduleName) . "-view/" .strtolower($moduleName) . "-view.component';\n\n";
            $template .= "const routes: Routes = [\n";
            $template .= "\t{ path: '" .strtolower($moduleName) . "', component: " .ucfirst(strtolower($moduleName)). "Component },\n";
            $template .= "\t{ path: '" .strtolower($moduleName) . "/add', component: " .ucfirst(strtolower($moduleName)). "AddComponent },\n";
            $template .= "\t{ path: '" .strtolower($moduleName) . "/edit/:id', component: " .ucfirst(strtolower($moduleName)). "AddComponent },\n";
            $template .= "\t{ path: '" .strtolower($moduleName) . "/view/:id', component: " .ucfirst(strtolower($moduleName)). "ViewComponent }\n";
            $template .= "];\n\n";
            $template .= "@NgModule({\n\timports: [RouterModule.forChild(routes)],\n\texports: [RouterModule]\n})\n\nexport class " .ucfirst(strtolower($moduleName)) ."RoutingModule { }";
    
            return htmlentities($template);		
        }        

        /**
         * Returns a string of a class formatted for C#
         *
         * @return string
         */         
        public static function generateCSharpClass($classStructure, $moduleName)
        {
            if (!empty($classStructure))
            {
                $className = "FormClass";
                
                if (isset($moduleName))
                {
                    $className = ucfirst($moduleName);
                }
                
                $template = "\npublic class " .$className ."\n{\n";

                foreach($classStructure as $value)
                    $template .= "\tpublic string " .ucfirst($value) ." { get; set; }\n\n";

                $template = rtrim($template, "\n\n");
                $template .= "\n}";
    
                return htmlentities($template);
            }
            
            return null;
        }

        /**
         * Returns a string formatted into Bootstrap HTML form fields
         *
         * @return string
         */
        public static function generateBootstrapTemplate($id, $label, $name, $type, $addAngularModelBinding = false)
		{
			$id = trim($id);
			$label = trim($label);
			$name = trim($name);
			$type = trim($type);
			
            $typeText = "";

            $angularModelBinding = " [(ngModel)]=\"model." .$name ."\"";
            
            if (strtolower($type) == "radio" || strtolower($type) == "select")
            {
                $angularModelBinding = " [(ngModel)]=\"model." .lcfirst($id) ."\"";
            }

            if ($addAngularModelBinding == false)
            {
                $angularModelBinding = "";
            }
            
			if (strtolower($type) == "email")
				$typeText = " type=\"email\"";
			else if (strtolower($type) == "password")
				$typeText = " type=\"password\"";
			else if (strtolower($type) != "type")
				$typeText = " type=\"" .$type ."\"";
		
            $template = 
                "\n<div class=\"form-group\">\n" .
                    "\t<label for=\"" .$id ."\">" .$label ."</label>\n" .
                    "\t<input" .$typeText ." id=\"" .$id ."\" name=\"" .$name ."\" class=\"form-control\" placeholder=\"Enter " .$label ."\"" .$angularModelBinding ."/>\n" .
                "</div>";
            
			if (strtolower($type) == "textarea")
			{
                $template = 
                    "\n<div class=\"form-group\">\n" .
                    "\t<label for=\"" .$id ."\">" .$label ."</label>\n" .
                    "\t<textarea id=\"" .$id ."\" name=\"" .$name ."\" class=\"form-control\" placeholder=\"Enter " .$label ."\"" .$angularModelBinding ."></textarea>\n" .
                    "</div>";
			}

			if (strtolower($type) == "checkbox")
			{
                $template = 
                    "\n<div class=\"form-group\">\n" .
                    "\t<div class=\"checkbox\">\n" .
                        "\t\t<label for=\"" .$id ."\">" .$label ."</label>\n" .
                        "\t\t<input type=\"checkbox\" id=\"" .$id ."\" name=\"" .$name ."\" value=\"1\"" .$angularModelBinding ."> " .$label ."\n" .
                    "\t</div>\n" .
                    "</div>";
			}

			if (strtolower($type) == "radio")
			{
				$radioOptions = "";
				$options = explode("|", $name);
				
				foreach($options as $option)
					if (strlen(trim($option)) > 0)
						$radioOptions .= "\t\t<input type=\"radio\" name=\"" .$id ."\" value=\"" .trim($option) ."\"" .$angularModelBinding ."> " .trim($option) ."\n";
				
				$template = 
                    "\n<div class=\"form-group\">\n" .
                    "\t<div class=\"radio\">\n" .
                        "\t\t<label>" .$label ."</label>\n" .$radioOptions .	
                    "\t</div>\n" .
                    "</div>";
			}
			
			if (strtolower($type) == "select")
			{
                $selectOptions = "";
                $options = explode("|", $name);
                
                foreach($options as $option)
                    if (strlen(trim($option)) > 0)
                        $selectOptions .= "\t\t<option value=\"" .trim($option) ."\">" .trim($option) ."</option>\n";
                
                $template = 
                    "\n<div class=\"form-group\">\n" .
                    "\t<label for=\"" .$id ."\">" .$label ."</label>\n" .
                    "\t<select id=\"" .$id ."\" name=\"" .$id ."\" class=\"form-control\"" .$angularModelBinding .">\n" .$selectOptions .	
                    "\t</select>\n" .
                    "</div>";
			}		
			
			return htmlentities($template);
        }
        
        /**
         * Returns a string wrapped around a HTML form field
         *
         * @return string
         */        
        public static function generateFormDefinition($fields, $moduleName, $addAngularModelBinding = false)
        {
            $angularModelBinding = " #" .ucfirst($moduleName) . "Form=\"ngForm\"";

            if ($addAngularModelBinding == false)
            {
                $angularModelBinding = "";
            }

            $template = "\n<form id=\"" .ucfirst($moduleName) . "Form\"" .$angularModelBinding .">";
            $template .= html_entity_decode(str_replace("\n", "\n\t", $fields));            
            $template .= "\n</form>";

            return htmlentities($template);
        }

        /**
         * Returns a string of a class formatted for php
         *
         * @return string
         */         
        public static function generatePhpClass($classStructure, $moduleName)
        {
            if (!empty($classStructure))
            {
                $className = "FormModel";
                
                if (isset($moduleName))
                {
                    $className = ucfirst($moduleName);
                }

                $template = "\nclass " .$className ."\n{\n";

                    foreach($classStructure as $value)
                        $template .= "\tpublic $" . lcfirst($value) .";\n\n";  

                $template = rtrim($template, "\n\n");
                $template .= "\n\n\tpublic function __construct()\n\t{\n";

                    foreach($classStructure as $value)
                        $template .= "\t\t$" ."this" ."->" .lcfirst($value) ." = $" ."_POST" ."['" .lcfirst($value) ."'];\n";

                $template .= "\t}";
                $template .= "\n}";
    
                return htmlentities($template);
            }
            
            return null;
        }
        
        /**
         * Returns a string of an index.js file formatted for React Native
         *
         * @return string
         */        
        public static function generateReactNativeIndex($moduleName)
        {
            $className = "Form";
                
            if (isset($moduleName))
            {
                $className = ucfirst(strtolower($moduleName));
            }
            
            $template = "\nimport " .$className ." from './" .$className ."';\nimport styles from './styles';\n\nexport {\n\t" .$className .",\n\tstyles\n};";

            return htmlentities($template);
        }

        /**
         * Returns a string of an model of form fields formatted for React Native
         *
         * @return string
         */        
        public static function generateReactNativeModel($formValues, $moduleName)
        {
            $className = "Form";
                
            if (isset($moduleName))
            {
                $className = ucfirst(strtolower($moduleName));
            }

            $template = "\nimport React, { Component } from 'react';\n";
            $template .= "import { CheckBox, Picker, ScrollView, Text, TextInput, View } from 'react-native';\n";

            foreach ($formValues as $values)
            {
                $type = trim($values[3]);

                if (strtolower($type) == "radio")
                {
                    $template .= "import { RadioButtons } from 'react-native-radio-buttons';\n";
                    break;
                }                
            }
            
            $template .= "import styles from './styles';\n\n";

            $template .= "class " .$className ." extends Component {\n\tconstructor(props)\n\t{\n\t\tsuper(props);\n\n\t\tthis.state = {};\n\t}\n\n";
            $template .= "\tonInputChange = (text, stateKey) => {\n\t\tconst mod = {};\n\t\tmod[stateKey] = text;\n\t\tthis.setState(mod);\n\t}\n\n";

            foreach ($formValues as $values)
            {
                $type = trim($values[3]);

                if (strtolower($type) == "radio")
                {
                    $template .= "\tsetSelectedOption = (selectedOption) => {\n";
                    $template .= "\t\tthis.setState({\n";
                    $template .= "\t\t\tselectedOption\n";
                    $template .= "\t\t});\n";
                    $template .= "\t}\n\n";

                    $template .= "\trenderOption = (option, selected, onSelect, index) => {\n";
                    $template .= "\t\tconst style = selected ? { fontWeight: 'bold' } : {};\n\n";

                    $template .= "\t\treturn (\n";
                    $template .= "\t\t\t<TouchableWithoutFeedback onPress={onSelect} key={index}>\n";
                    $template .= "\t\t\t\t<Text style={style}>{option}</Text>\n";
                    $template .= "\t\t\t</TouchableWithoutFeedback>\n";
                    $template .= "\t\t);\n";
                    $template .= "\t}\n\n";

                    $template .= "\trenderContainer = (optionNodes) => {\n";
                    $template .= "\t\treturn <View>{optionNodes}</View>;\n";
                    $template .= "\t}\n\n";
                    break;
                }                
            }            

            $template .= "\trender() {\n";

            foreach ($formValues as $values)
            {
                $id = trim($values[0]);
                $name = trim($values[2]);
                $type = trim($values[3]);

                if (strtolower($type) == "radio")
                {
                    $template .= "\t\tconst " .lcfirst($id) ."Options = [\n";
                    
                    $options = explode("|", $name);
				
                    foreach($options as $option)
                        if (strlen(trim($option)) > 0)
                            $template .= "\t\t\t\"" .trim($option) ."\",\n";

                    $template .= "\t\t];\n\n";
                }
            }

            $template .= "\t\treturn (\n";
            $template .= "\t\t\t<ScrollView>\n";
            $template .= "\t\t\t\t<View>";

            foreach ($formValues as $values)
            {
                $id = trim($values[0]);
                $label = trim($values[1]);
                $name = trim($values[2]);
                $type = trim($values[3]);
                
                $typeText = "";
                
                if (strtolower($type) == "email")
                    $typeText = " type=\"email\"";
                else if (strtolower($type) == "password")
                    $typeText = " type=\"password\"";
                else if (strtolower($type) != "type")
                    $typeText = " type=\"" .$type ."\"";
                
                $field = "\n\t\t\t\t\t<View>\n";
                $field .= "\t\t\t\t\t\t<TextInput\n";
                $field .= "\t\t\t\t\t\t\tautoCorrect={false}\n";
                $field .= "\t\t\t\t\t\t\tautoCapitalize='none'\n";
                $field .= "\t\t\t\t\t\t\tplaceholder='Enter " .$label ."'\n";
                $field .= "\t\t\t\t\t\t\tonChangeText={(text) => this.onInputChange(text, '" .lcfirst($id) ."')}\n";
                $field .= "\t\t\t\t\t\t\tvalue={this.state['" .lcfirst($id) ."']}\n";
                $field .= "\t\t\t\t\t\t/>\n";
                $field .= "\t\t\t\t\t</View>";
        
                if (strtolower($type) == "textarea")
                {
                    $field = "\n\t\t\t\t\t<View>\n";
                    $field .= "\t\t\t\t\t\t<TextInput\n";
                    $field .= "\t\t\t\t\t\t\tmultiline\n";
                    $field .= "\t\t\t\t\t\t\tautoCorrect={false}\n";
                    $field .= "\t\t\t\t\t\t\tautoCapitalize='none'\n";
                    $field .= "\t\t\t\t\t\t\tplaceholder='Enter " .$label ."'\n";
                    $field .= "\t\t\t\t\t\t\tonChangeText={(text) => this.onInputChange(text, '" .lcfirst($id) ."')}\n";
                    $field .= "\t\t\t\t\t\t\tvalue={this.state['" .lcfirst($id) ."']}\n";
                    $field .= "\t\t\t\t\t\t/>\n";
                    $field .= "\t\t\t\t\t</View>";                    
                }
    
                if (strtolower($type) == "checkbox")
                {
                    $field = "\n\t\t\t\t\t<View>\n";
                    $field .= "\t\t\t\t\t\t<Text>" .$label ."</Text>\n";
                    $field .= "\t\t\t\t\t\t<CheckBox\n";
                    $field .= "\t\t\t\t\t\t\tvalue={this.state['" .lcfirst($id) ."']}\n";
                    $field .= "\t\t\t\t\t\t\tonValueChange={(value) => this.onInputChange(value, '" .lcfirst($id) ."')}\n";
                    $field .= "\t\t\t\t\t\t/>\n";
                    $field .= "\t\t\t\t\t</View>";
                }
    
                if (strtolower($type) == "radio")
                {
                    $field = "\n\t\t\t\t\t<View>\n";
                    $field .= "\t\t\t\t\t\t<Text>" .$label ."</Text>\n";
                    $field .= "\t\t\t\t\t\t<RadioButtons\n";
                    $field .= "\t\t\t\t\t\t\toptions={" .lcfirst($id) ."Options}\n";
                    $field .= "\t\t\t\t\t\t\tonSelection={setSelectedOption.bind(this)}\n";
                    $field .= "\t\t\t\t\t\t\tselectedOption={this.state.selectedOption}\n";
                    $field .= "\t\t\t\t\t\t\trenderOption={renderOption}\n";
                    $field .= "\t\t\t\t\t\t\trenderContainer={renderContainer}\n";
                    $field .= "\t\t\t\t\t\t/>\n";
                    $field .= "\t\t\t\t\t</View>";
                }
                
                if (strtolower($type) == "select")
                {                    
                    $field = "\n\t\t\t\t\t<View>\n";
                    $field .= "\t\t\t\t\t\t<Text>" .$label ."</Text>\n";
                    $field .= "\t\t\t\t\t\t<Picker\n";
                    $field .= "\t\t\t\t\t\t\tselectedValue={this.state['" .lcfirst($id) ."']}\n";
                    $field .= "\t\t\t\t\t\t\tonValueChange={(option, index) => this.onInputChange(option, '" .lcfirst($id) ."')}\n";
                    $field .= "\t\t\t\t\t\t>\n";

                    $options = explode("|", $name);
                    
                    foreach($options as $option)
                        if (strlen(trim($option)) > 0)
                            $field .= "\t\t\t\t\t\t\t<Picker.Item label=\"" .trim($option) ."\" value=\"" .trim($option) ."\" />\n";                    

                    $field .= "\t\t\t\t\t\t</Picker>\n";
                    $field .= "\t\t\t\t\t</View>";  
                }               
                
                $template .= $field;
            }

            $template .= "\n\t\t\t\t</View>\n";
            $template .= "\t\t\t</ScrollView>\n";
            $template .= "\t\t);\n";
            $template .= "\t}\n";
            $template .= "};\n\nexport default " .$className .";";

            return htmlentities($template);
        }

        /**
         * Returns a string of a styles.js file formatted for React Native
         *
         * @return string
         */        
        public static function generateReactNativeStyles()
        {
            $template = "\nimport { StyleSheet } from 'react-native';\n\n";
            $template .= "export default StyleSheet.create({\n\n});";

            return htmlentities($template);
        }        
    } /*end of class GeneratorModel*/
<?php

class CForm
{

    public $label;
    public $name;
    public $type       = "text";
    public $isDisabled = false;
//     public $selectValues = [];
    public $value = "";

    public $placeholder = "";
    public $isRequired  = false;

    private $customOutput = "";

    public $model             = null;
    public $isButton          = false;
    public $isArray           = false;
    public $isPhoto           = false;
    public $isHidden          = false;
    public $isReadOnly        = false;
    public $bottomDescription = "";
    public $cssContainer =  "";
    public $titleTop =  "";

    public function __construct($label, $name, $type = "text")
    {

        $this->label       = $label;
        $this->name        = $name;
        $this->type        = $type;
//        $this->placeholder = "Masukan $label";
//         debug($errors->all());
        if (old($this->name)) {
            $this->value = getSemicolonFormat(old($this->name));
        }

//         $this->value  =  old($this->name);

    }


    public function setGone($isGone)
    {
        $this->isDisabled = $isGone;
        $this->isHidden   = $isGone;
        $this->isRequired = !$isGone;
    }

    public function setModel($model)
    {

        if ($model == null) {
            return;
        }
        $name       = $this->name;
        $modelValue = $model->$name;
//        debug($model);
        if ($modelValue != NULL) {
            $this->value = $modelValue;

        }
    }

    public function setInputTypePhoto()
    {
        $this->type    = 'file';
        $this->isPhoto = true;
        $this->label   = "$this->label. Maximum file 5000KB";
    }


    private function getIsDisabled()
    {
        return $this->isDisabled ? "disabled" : "";
    }

    public function setInputTypeSelect($values = [], Illuminate\Database\Eloquent\Collection $model = null)
    {
//        $this->placeholder = "Pilih $this->label";
//        $values[]="Pilih /"
        if ($model != null) {

            foreach ($model as $currentModel) {
                $values[] = $currentModel->name;
            }
        }
//         $this->selectValues = $values;

        $option = "              ";

        foreach ($values as $value) {
            $isSelected = $this->value == $value ? "selected" : "";
            $ucValue    = ucwords($value);
//            $option .= "<option $isSelected ue=''>Pilih $this->placeholder</option>";
            $option     .= "
                <option $isSelected value='$value'>$ucValue</option>
             ";
        }

        $labelClass = $this->isRequired && !$this->isReadOnly && !$this->isHidden? "label-required" : "";
        $isRequired = $this->isRequired && !$this->isReadOnly && !$this->isHidden? "required=''" : "";

        $selectClass = $this->isButton ? "span2 selectpicker search-select" : "";

        $isArray = $this->isArray ? "[]" : "";
        $isDisabled = $this->isDisabled ? "disabled" : "";


        $this->customOutput = "
            <select  $isDisabled {$this->getIsDisabled()}  class='$selectClass' placeholder='$this->placeholder' name='$this->name{$isArray}' id='$this->value' $isRequired>
               <option value=''>$this->placeholder</option>
               $option;
            </select>
         ";

        $this->type = "select";
    }

    public function setInputTypeCheckbox($values = [], Illuminate\Database\Eloquent\Collection $model = null)
    {


        try {
            $this->type = "checkbox";
            if ($model != null) {
                foreach ($model as $currentModel) {
                    $values[] = $currentModel->name;
                }
            }
            $customOutput = "";
            foreach ($values as $value) {
                $isChecked  = strpos($this->value, $value) > -1 ? "checked" : "";
                $labelClass = $this->isRequired && !$this->isReadOnly && !$this->isHidden? "label-required" : "";
                $ucValue    = ucwords($value);
                $isDisabled = $this->isDisabled ? "disabled" : "";
                if (!$this->isButton && !$this->isDisabled) {
                    $customOutput .= "
                <label for='checkbox-$value' class='checkbox $labelClass' ><input {$this->getIsDisabled()} {$this->getIsRequired()} id='checkbox-$value' type='checkbox' name='$this->name[]' value='$value' $isChecked/> $ucValue</label>
             ";
                }
                if($this->isDisabled){
                    $customOutput = "<label>$this->value</label>";
                }


            }

            $this->customOutput = $customOutput;
        } catch (Exception $e) {
//             debug($this);
        }

    }

    private function getIsRequired()
    {
        return $this->isRequired && !$this->isReadOnly && !$this->isHidden? "required" : "";

    }

    public function getOutput()
    {
        $this->label = ucwords($this->label);
        $output      = "";
        $labelClass  = $this->isRequired && !$this->isReadOnly && !$this->isHidden? "label-required" : "";
        if (!$this->isButton) {
            $output .= "
                        <label class='$labelClass' for='$this->name'>$this->label</label>
                     ";
        }

        $isRequired = $this->isRequired && !$this->isReadOnly && !$this->isHidden ? "required" : "";
        $isArray    = $this->isArray ? "[]" : "";
        $isDisabled = $this->isDisabled ? "disabled" : "";


        $maxWidth = '';
        if($this->type == 'number'){
            $maxWidth = 'max-width: 150px;';
        }
        switch ($this->type) {
            case "text":
            case "number":
            case "email":
            case "password":
            case "tel":
            case "file":

                $output .= "<input $isDisabled style='$maxWidth' {$this->getIsDisabled()} placeholder='$this->placeholder' id='$this->name' class='input-block-level' $isRequired type='$this->type' name='$this->name{$isArray}' value='$this->value'/>";
                break;

            case "select":
            case "checkbox":
                $output .= "$this->customOutput";
                break;
            case "textarea":
                $output .= "<textarea $isDisabled {$this->getIsDisabled()} style='display:block;width:100%;' row='4' name='$this->name{$isArray}' placeholder='$this->placeholder'>$this->value</textarea>";
        }

        $output .= "<div style='margin-bottom: 16px'>$this->bottomDescription</div>";

        $isHidden         = $this->isHidden ? "display:none;" : "";
        $outputWrapHidden = "<div style='{$isHidden};$this->cssContainer'>$output</div>";
        if($this->titleTop){
            return "<label style='margin-bottom: 12px;'>$this->titleTop<label/>";
        }
        return  "". $outputWrapHidden;
    }

    public function getValidationRule()
    {
        $validation = [];
        if ($this->isRequired && !$this->isReadOnly && !$this->isHidden) {
            $validation[] = "required";
        }
        if ($this->isArray) {
            $validation[] = "array";
        }

        if ($this->type == "number") {
            $validation[] = "numeric";
        }
        if ($this->isPhoto) {
            $validation[] = "mimes:jpeg,bmp,png";
        }
        if ($this->type == 'file') {
            $validation[] = "max:5000";
        }

        return [$this->name => implode('|', $validation)];

    }
//     private getIsReadOnly(){}
}


?>
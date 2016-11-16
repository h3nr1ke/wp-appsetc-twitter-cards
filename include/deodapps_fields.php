<?php
/**
 * Generate basic fiedls to be reused
 * @author  Henrique Deodato <[h3nr1ke@gmail.com]>
 */

defined( 'ABSPATH' ) or die( 'Não não, perdão...' );

class FormField{
  private $label = "";
  private $id = "";
  private $description = "";
  private $type = "";
  private $prefix = "wp_deodapps_twc";
  private $value = "";
  private $size = "30";

  public function setLabel($_label){$this->label = $_label; }
  public function setId($_id){$this->id = $_id; }
  public function setDescription($_desc){$this->description = $_desc; }
  public function setType($_type){$this->type = $_type; }
  public function setPrefix($_prefix){$this->prefix = $_prefix; }
  public function setValue($_value){$this->value = $_value; }
  public function setSize($_size){$this->size = $_size; }

  public function text(){
    $output = sprintf('<div class="form-row">
      <div class="label">
        <label for="%s">%s</label>
      </div>
      <div class="field">
        <input type="text" name="%s" id="%s" value="%s" size="%s" />
        <br /><span class="description">%s</span>
      </div>
    </div>',$this->id,$this->label,$this->id,$this->id,$this->value,$this->size,$this->description);
    return $output;
  }
  public function checkbox(){
    $output = sprintf('<div class="form-row">
      <div class="label">
        <label for="%s">%s</label>
      </div>
      <div class="field">
        <input type="checkbox" name="%s" id="%s" value="%s" size="%s" />
        <br /><span class="description">%s</span>
      </div>
    </div>',$this->id,$this->label,$this->id,$this->id,$this->value,$this->size,$this->description);
    return $output;
  }
}
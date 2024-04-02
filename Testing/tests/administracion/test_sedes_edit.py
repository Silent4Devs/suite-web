from pages.administracion.configurar_organizacion.sedes.edit.sedes_edit_page import Edit_sedes
 
def test_edit_sedes(browser):
    
 create_edit = Edit_sedes(browser)
 create_edit.login()
 create_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 create_edit.adit_sedes( campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/sedes'][text()='Sedes']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"


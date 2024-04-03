from pages.administracion.configurar_organizacion.crear_areas.edit.crear_areas_edit_page import Edit_Crear_Areas
 
def test_create_crear_areas(browser):
    
 edit_crear_areas = Edit_Crear_Areas(browser)
 edit_crear_areas.login()
 edit_crear_areas.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 edit_crear_areas.edit_crear_areas(campo_buscar_xpath,trespuntos_btn_xpath,boton_editar,guardar_xpath)
 
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/areas'][text()='Crear Áreas']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"



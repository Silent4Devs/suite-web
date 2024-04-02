from pages.administracion.configurar_organizacion.crear_grupo_de_areas.edit.g_d_areas_edit_page import Edit_G_D_Areas
 
def test_edit_g_d_areas(browser):
    
 edit_g_d_areas = Edit_G_D_Areas(browser)
 edit_g_d_areas.login()
 edit_g_d_areas.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 edit_g_d_areas.edit_g_d_areas(campo_buscar_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/grupoarea'][text()='Crear Grupo de Áreas']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"

boton_editar = "//I[@class='fas fa-edit']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"


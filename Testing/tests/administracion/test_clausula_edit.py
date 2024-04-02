from pages.administracion.ajustes_sg.clausula.edit.clausula_edit_page import Edit_clausula
 
def test_clasificacion_create(browser):
    
 clasifiacion_edit = Edit_clausula(browser)
 clasifiacion_edit.login()
 clasifiacion_edit.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 clasifiacion_edit.update_clausula(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias'][text()='Cláusula']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "(//I[@class='fa-solid fa-pencil'])[1]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"


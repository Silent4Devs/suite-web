from pages.administracion.ajustes_sg.clausula.create.clausula_create_page import Create_clausula
 
def test_clasificacion_create(browser):
    
 clasifiacion_create = Create_clausula(browser)
 clasifiacion_create.login()
 clasifiacion_create.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 clasifiacion_create.add_clausula(agregar_btn_xpath)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias'][text()='Cláusula']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//A[@href='https://192.168.9.78/admin/auditorias/clausulas-auditorias/create'][text()='Nueva Cláusula']"


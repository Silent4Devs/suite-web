import time
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

#TEST LISTA DE DISTRIBUCION

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//a[contains(@href, '/admin/lista-distribucion') and normalize-space()='Lista de distribución']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "//A[@href='/admin/lista-distribucion/4/edit']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
guardar_xpath = "//BUTTON[@type='submit'][text()='Editar']"

#Temporizadores
tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
tiempo_tres = 3

@pytest.fixture
def driver():
    driver = webdriver.Firefox()
    yield driver
    driver.quit()
    

def test_lista_d_distribucion(driver):

    # Abrir la URL de Tabantaj
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usuario = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys("admin@admin.com")
    time.sleep(tiempo_modulos)
    password = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys("#S3cur3P4$$w0Rd!")
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    
    # Entrando a Menu Hamburguesa
    print("URL actual:", driver.current_url)
    print("Entrando a Menu Hamburguesa...")
    element = driver.find_element(By.XPATH, menu_hamburguesa)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, menu_hamburguesa)))
    print("Dando clic en Menu Hamburguesa...")
    element.click()

    time.sleep(tiempo_modulos)
    
    # Entrando a Modulo Ajustes SG
    print("Entrando a Modulo Ajustes SG...")
    element = driver.find_element(By.XPATH, element_confirgurar_organizacion)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_confirgurar_organizacion)))
    print("Dando clic en Modulo Ajustes SG...")
    element.click()
    
    time.sleep(tiempo_modulos)

    # Entrando a Sub Modulo Clasificacion
    print("Entrando a Sub Modulo Clasifiacion...")
    entrar = driver.find_element(By.XPATH,element_entrar_submodulo)
    driver.execute_script("arguments[0].scrollIntoView(true);", element)
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,element_entrar_submodulo)))
    print("Dando clic en Sub Modulo Clasifiacion...")
    entrar.click()
    
    time.sleep(tiempo_modulos)
    
    
    #################################BUSCAR REPOSITORIO Y ENTRAR A BOTONES DE EDICION###################################
    
    # Boton 3 puntos
    print("Dando clic al botón 3 puntos...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    puntos_btn = wait.until(EC.presence_of_element_located((By.XPATH, trespuntos_btn_xpath)))
    # Ahora intenta hacer clic en el elemento
    puntos_btn.click()

    time.sleep(tiempo_modulos)
    
    # Boton editar
    print("Dando clic al botón editar...")
    wait = WebDriverWait(driver, 10)
    # Esperar a que el elemento esté presente en el DOM
    btn_editar = wait.until(EC.presence_of_element_located((By.XPATH,boton_editar)))
    # Ahora intenta hacer clic en el elemento
    btn_editar.click()

    time.sleep(tiempo_modulos)  
    
    # Seleccione niveles
    campo_niveles = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//SELECT[@id='niveles']"))
        )
    campo_niveles.click()
    time.sleep(tiempo_espera)
    campo_niveles.send_keys("2")
    time.sleep(tiempo_espera)
    campo_niveles.click()
    
    # Guardar actualización
    print("Dando clic al botón Guardar para guardar actualización...")
    guardar = WebDriverWait(driver, 20).until(
        EC.element_to_be_clickable((By.XPATH, guardar_xpath))
    )
    guardar.click()

    time.sleep(tiempo_modulos)




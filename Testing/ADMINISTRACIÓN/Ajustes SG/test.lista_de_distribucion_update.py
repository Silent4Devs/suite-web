from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time

#Variables
tiempo_modulos = 5
tiempo_carga = 10
tiempo_espera = 2.5
element_xpath0 = "//I[@class='bi bi-file-earmark-arrow-up']"
element_lista_d_distribucion = "(//LI)[10]"
clasificacion_xpath="//a[contains(.,'Clasificación')]"
crear_organizacion_btn_xpath= "//a[@href='https://192.168.9.78/admin/organizacions/1/edit' and normalize-space()='Editar Organización']"
panel_de_control = "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
id_xpath="///input[contains(@type,'number')]"
save_btn_xpath="//BUTTON[@type='submit'][text()='Editar']"
opciones_xpath="(//i[contains(@class,'fa-solid fa-ellipsis-vertical')])[1]"
editar_xpath="(//a[contains(.,'Editar')])[1]"

#Temporizadores
tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5

# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = input("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()


try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    time.sleep(tiempo_modulos)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)
    time.sleep(tiempo_modulos)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//font[@class='letra_blanca'][contains(.,'Mi perfil')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

time.sleep(tiempo_modulos)

#Entrando a menu hamburguesa
menu_hambuerguesa=driver.find_element(By.XPATH,"//BUTTON[@class='btn-menu-header']")
menu_hambuerguesa.click()
time.sleep(tiempo_modulos)

time.sleep(tiempo_modulos)

#Modulo Ajustes SG
print("Entrando a Configurar Organizacion...")
element = driver.find_element(By.XPATH, element_xpath0)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath0)))
print("Dando clic en Configurar Organizacion...")
element.click()

time.sleep(tiempo_modulos)

#Sub Lista de Distribucion
print("Entrando a Sub modulo, Lista de distribucion...")
element = driver.find_element(By.XPATH, element_lista_d_distribucion)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_lista_d_distribucion)))
print("Dando clic en Sub modulo Organizacion...")
element.click()

time.sleep(tiempo_modulos)

#Botones 3 puntos
print("Dando clic en boton 3 puntos")
wait = WebDriverWait(driver, 10)
# Esperar a que el elemento esté presente en el DOM
crear_clasificacion_btn = wait.until(EC.presence_of_element_located((By.XPATH, panel_de_control)))
# Ahora intenta hacer clic en el elemento
crear_clasificacion_btn.click()

#Seleccionar btn editar

btneditar = driver.find_element(By.XPATH,"//A[@href='/admin/lista-distribucion/4/edit']").click()
time.sleep(tiempo_espera)

#Seleccionar Niveles

btnnombre=driver.find_element(By.XPATH,"//SELECT[@id='niveles']").click()
time.sleep(tiempo_espera)
btnnombre2=driver.find_element(By.XPATH,"//SELECT[@id='niveles']").send_keys("3")
time.sleep(tiempo_espera)
btnnombre2=driver.find_element(By.XPATH,"//SELECT[@id='niveles']").click()
time.sleep(tiempo_espera)

#Campo Nivel 1
def Nivel_1(driver):
    # Obtener la entrada del usuario desde la terminal
    coloborador_ingresado = input("Ingresa nuevo Coloborador: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//UL[@class='select2-selection__rendered'])[2]"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(coloborador_ingresado)

#Llamando a la función Correo
Nivel_1(driver)

time.sleep(tiempo_modulos)


#Nivel 2
def Nivel_2(driver):
    # Obtener la entrada del usuario desde la terminal
    coloborador_ingresado_2 = input("Ingresa nuevo Coloborador: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//UL[@class='select2-selection__rendered'])[3]"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(coloborador_ingresado_2)

#Llamado a la funcion Giro
Nivel_2(driver)

time.sleep(tiempo_modulos)

#Nivel 3
def Nivel_3(driver):
    # Obtener la entrada del usuario desde la terminal
    telefono_ingresado = input("Ingresa nuevo Telefono: ")

    # Encontrar el campo de entrada
    campo_entrada = WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "(//UL[@class='select2-selection__rendered'])[4]"))
    )

    # Limpiar el campo de entrada y escribir el número ingresado por el usuario
    campo_entrada.clear()
    campo_entrada.send_keys(telefono_ingresado)
#Llamando a la función Telefono
Nivel_3(driver)

time.sleep(tiempo_modulos)


#Guardar
def clic_editar(driver):
    print("Dando clic al botón Guardar...")
    # Esperar hasta que el elemento sea visible
    guardar_btn = WebDriverWait(driver, 10).until(
        EC.visibility_of_element_located((By.XPATH, save_btn_xpath))
    )
    guardar_btn.click()


#Llamar a la función clic_guardar
clic_editar(driver)

#Llamar a la función Nivel 1
Nivel_1(driver)

#Llamar a la funcion Nivel 2
Nivel_2(driver)

#Llamar a la funcion Nivel 3
Nivel_3(driver)









/**
 * Файл navigation.js.
 *
 * Обрабатывает переключение меню навигации для маленьких экранов и включает поддержку навигации по клавише TAB для выпадающих меню.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Вернитесь раньше, если навигация не существует.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Вернитесь раньше, если кнопка не существует.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Скрыть кнопку переключения меню, если меню пусто и вернуться раньше.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Переключать класс .toggled и расширенное значение aria при каждом нажатии кнопки.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Удалите класс .toggled и установите aria-extended в значение false, когда пользователь нажимает за пределами навигации.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Получить все элементы ссылки в меню.
	const links = menu.getElementsByTagName( 'a' );

	// Получить все элементы ссылки с детьми в меню.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Переключать фокусировку каждый раз, когда ссылка меню фокусируется или размыта.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Переключение фокуса каждый раз, когда ссылка на меню с детьми получает сенсорное событие.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Устанавливает или удаляет класс .focus для элемента.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Перемещайтесь вверх по предкам текущей ссылки, пока мы не нажмем .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}
}() );

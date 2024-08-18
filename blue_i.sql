-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER'),
(3, 'ROLE_MANAGER'),
(4, 'ROLE_SUPERVISOR'),
(5, 'ROLE_DEVELOPER'),
(6, 'ROLE_ANALYST'),
(7, 'ROLE_SUPPORT'),
(8, 'ROLE_EDITOR'),
(9, 'ROLE_VIEWER'),
(10, 'ROLE_CONTRIBUTOR');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'STATUS_ACTIVE'),
(2, 'STATUS_INACTIVE'),
(3, 'STATUS_PENDING'),
(4, 'STATUS_SUSPENDED'),
(5, 'STATUS_DELETED'),
(6, 'STATUS_APPROVED'),
(7, 'STATUS_REJECTED'),
(8, 'STATUS_ARCHIVED'),
(9, 'STATUS_COMPLETED'),
(10, 'STATUS_FAILED');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role_id`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ramon.munozn', 'ramon.munozn@idiem.cl', 'ramon.munozn', 'Ramón', 'Muñoz', 1, 1, '2024-08-18 03:22:23', '2024-08-18 03:22:23', NULL);

-- --------------------------------------------------------